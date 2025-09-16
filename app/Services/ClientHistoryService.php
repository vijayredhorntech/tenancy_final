<?php

namespace App\Services;

use App\Models\HistoryAgencyClient;
use App\Models\ClientDetails;



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



public function agencyGetClientHistory($clientId)
{
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




}
