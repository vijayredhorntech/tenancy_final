<?php

namespace App\Services;

use App\Models\HistoryAgencyClient;
use App\Models\ClientDetails;
use App\Services\AgencyService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ClientHistoryService
{
    /**
     * Save a new client history record
     *
     * @param  array  $data
     * @return HistoryAgencyClient
     */
    protected $agencyService;

    public function __construct(AgencyService $agencyService)
    {
        $this->agencyService = $agencyService;
    }

    public function save(array $data): HistoryAgencyClient
    {
        if($data['type'] == 'agency'){
            return $this->saveDataByAgency($data);
        }

        return HistoryAgencyClient::create([
            'user_id'     => $data['user_id'],
            'client_id'   => $data['client_id'] ?? null,
            'agency_id'   => $data['agency_id'] ?? null,
            'date_time'   => $data['date_time'] ?? now(),
            'type'        => $data['type'] ?? 'general',
            'description' => $data['description'] ?? null,
            'status'      => $data['status'] ?? 'active',
        ]);
    }



    /**
     * Fetch history records by filters
     *
     * @param  array  $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getHistory(array $filters)
    {
        if (isset($filters['type']) && $filters['type'] === 'agency') {
            return $this->agencyGetClientHistory($filters['client_id']);
        } else {
            // fallback for superadmin or general queries
            $query = HistoryAgencyClient::query();

            if (isset($filters['client_id'])) {
                $query->where('client_id', $filters['client_id']);
            }

            if (isset($filters['status'])) {
                $query->where('status', $filters['status']);
            }

            return $query->latest('date_time')->paginate(10); // default 10 per page
        }
    }



    /**
     * Ensure the history_agency_clients table exists in the user database
     */
    private function ensureTableExists()
    {
        if (!Schema::connection('user_database')->hasTable('history_agency_clients')) {
            Schema::connection('user_database')->create('history_agency_clients', function ($table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('client_id')->nullable();
                $table->unsignedBigInteger('agency_id')->nullable();
                $table->dateTime('date_time');
                $table->string('type')->nullable();
                $table->text('description')->nullable();
                $table->string('status')->nullable();
                $table->timestamps();
            });
        }
    }

    public function agencyGetClientHistory($clientId)
    {
        // Ensure the table exists before querying
        $this->ensureTableExists();

        $agency = $this->agencyService->getAgencyData();

        if (!$agency) {
            return collect(); // empty if no agency found
        }

        $histories = HistoryAgencyClient::on('user_database')
            ->where('agency_id', $agency->id)
            ->where('client_id', $clientId)
            ->latest('date_time')
            ->paginate(10);

        // Manually attach users from 'user_database' connection
        $histories->getCollection()->transform(function ($history) {
            $history->user = \App\Models\User::on('user_database')->find($history->user_id);
            return $history;
        });

        return $histories;
    }

    /****Save Data **** */
    public function saveDataByAgency($data){
        // Ensure the table exists before saving
        $this->ensureTableExists();

        $agency = $this->agencyService->getAgencyData();

        return HistoryAgencyClient::on('user_database')->create([
            'user_id'     => $data['user_id'],
            'client_id'   => $data['client_id'] ?? null,
            'agency_id'   => $data['agency_id'] ?? null,
            'date_time'   => $data['date_time'] ?? now(),
            'type'        => $data['type'] ?? 'general',
            'description' => $data['description'] ?? null,
            'status'      => $data['status'] ?? 'active',
        ]);
    }

    /*** Delete User Data ***/
    public function deleteClientHistory(array $data)
    {
        if ($data['type'] === 'agency') {
            return $this->deleteAgencyClientHistory($data);
        }

        $history = HistoryAgencyClient::where('id', $data['historyid'])->first();
        if ($history) {
            $history->delete();
        }

        return true;
    }


    public function updateHisotry($data){

        if ($data['type'] === 'agency') {
            return $this->updateAgencyClientHistory($data['data']);
        }
        $history = HistoryAgencyClient::on('user_database')->where('id', $data['history_id'])->first();
        if ($history) {
            $history->update([
                'user_id'     => $data['user_id'],
                'client_id'   => $data['client_id'] ?? null,
                'agency_id'   => $data['agency_id'] ?? null,
                'date_time'   => $data['date_time'] ?? now(),
                'type'        => $data['type'] ?? 'general',
                'description' => $data['description'] ?? null,
                'status'      => $data['status'] ?? 'active',
            ]);
        }

        return true;
    }

    
    public function updateAgencyClientHistory($data){
        $agency = $this->agencyService->getAgencyData();


       return HistoryAgencyClient::on('user_database')
            ->where('id', $data['history_id'])
            ->update([
                'description' => $data['description'] ?? null,
            ]);

   
    }

    public function deleteAgencyClientHistory(array $data)
    {
        // Assuming $this->agencyService->getAgencyData() is needed elsewhere
        $agency = $this->agencyService->getAgencyData();

        $history = HistoryAgencyClient::on('user_database')->where('id', $data['historyid'])->first();
        if ($history) {
            $history->delete();
        }

        return true;
    }




     /*** Get History By Id ***/
    public function getHistoryById(array $data)
    {

         if ($data['type'] === 'agency') {
            return $this->getAgencyClientHistory($data);
        }else{
            $history = HistoryAgencyClient::where('id', $data['historyid'])->first();
        }
         if ($history) {

              return $history;
            }
    
  
    } 

    public function getAgencyClientHistory(array $data)
    {

      $agency = $this->agencyService->getAgencyData();
 
        $history = HistoryAgencyClient::on('user_database')->where('id', $data['historyid'])->where('agency_id', $agency->id)->first();

        if ($history) {
            return $history;
        }

    }



    public function hseditHistory($clientId, $historyId)
{
    $clientDetails = Client::findOrFail($clientId);

    // fetch only the selected history item
    $history = CommunicationHistory::where('client_id', $clientId)
        ->where('id', $historyId)
        ->firstOrFail();

    // list all items again for table
    $histories = CommunicationHistory::where('client_id', $clientId)
        ->orderBy('id','DESC')
        ->get();

    $user = auth()->user();

    // pass edit item
    return view('agency.callhistory', compact('clientDetails','history','histories','user'));
}

public function hsupdateHistory(Request $request, $clientId, $historyId)
{
    $request->validate([
        'description' => 'required|string|max:500',
    ]);

    $history = CommunicationHistory::where('client_id', $clientId)
        ->where('id', $historyId)
        ->firstOrFail();

    $history->description = $request->description;
    $history->save();

    return redirect()->route('agency.client.history', $clientId)
        ->with('success', 'History updated successfully!');
}

}
