<?php

namespace App\Repositories;

use App\Models\Visa;
use App\Models\Country;
use App\Models\VisaServices;
use App\Models\VisaSubtype;
use App\Models\VisaServiceType;
use App\Models\VisaBooking;
use App\Models\Deduction;
use App\Models\Balance;
use App\Models\Agency;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\VisaRepositoryInterface;
use App\Services\FileUploadService;
use Auth; 
use Illuminate\Support\Str;
use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Config;


class VisaRepository implements VisaRepositoryInterface
{
    
    protected $fileUploadService;
    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function getAllCountry(){

       return Country::paginate(10);
    }


    public function getAllVisas()
    {
        return VisaServices::paginate(10);
    }


    public function getVisaById($id)
    {
        return VisaServices::with('VisavisaSubtype')->find($id);
    }

    /***Create Visa name and sub type**** */
    public function createVisa(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Create Visa
            $visa = new VisaServices();
            $visa->name = $data['name'];
            $visa->description = $data['description'];
            $visa->save();
    
            // Save Visa Subtypes in a loop
            foreach ($data['subtype'] as $key => $subtypeName) {
                VisaSubtype::create([
                    'visa_type_id' => $visa->id, // Assuming Visa Type ID is the VisaService ID
                    'name' => $subtypeName,
                    'price' => $data['subtypeprice'][$key],
                    'commission' => $data['commission'][$key],
                    'status' => 1 // Default status as active
                ]);
            }
    
            return $visa;
        });
    }
    

/***** Assign Visa to Country ********/
public function assignVisaToCountry(array $data)
{
 
    return DB::transaction(function () use ($data) {
        $assign = new VisaServiceType();
        $authUserId = auth()->id();
       
        // Handle file upload if 'title_image' is present
        if (isset($data['title_image'])) {
      
            $uploadedFilePath = $this->fileUploadService->uploadFile(
                $data['title_image'], 
                'images/visa/titleimages/', 
                $authUserId
            );
               // Save file path in DB
             $assign->title_image = $uploadedFilePath;
        }

        $assign->origin = $data['origincoutnry']; // Fixed typo
        $assign->destination = $data['destination'];
        $assign->visa_id = $data['visa_id'];
        $assign->description = $data['description'] ?? null;
        $assign->required = $data['required'];
        $assign->save();

        return $assign;
    });
}


public function getVisabySearch($origin,$destination){
    return VisaServiceType::with('VisaServices','Subvisas')->where('origin',$origin)->where('destination',$destination)->get();
}


public function getVisabySearchcoutnry($id){
    return VisaServiceType::where('id',$id)->first();
}


public function updateVisa($id, array $data)
{
    
    // Find the Visa record
    $visa = VisaServices::findOrFail($id);

    // Update Visa details
    $visa->name = $data['name'];
    $visa->description = $data['description'];
    $visa->save();

    // Check if subtypes exist
    if (isset($data['subtype']['0'])) {
  
        foreach ($data['subtype'] as $key => $subtypeName) {
            VisaSubtype::updateOrCreate(
                [
                    'visa_type_id' => $id,
                    'id' => $data['subtype_id'][$key] ?? null // If an ID exists, update it
                ],
                [
                    'name' => $subtypeName,
                    'price' => $data['subtypeprice'][$key] ?? 0,
                    'commission' => $data['commission'][$key] ?? 0,
                    'status' => 1, // Default status as active
                ]
            );
        }
    }
  

    return $visa;
}


  public function allVisacoutnry(){
    return VisaServiceType::with('origincountry','destinationcountry','VisaServices','Subvisas')->get(); 
  }



  public function saveBooking(array $data)
  {
      $subtype = VisaSubtype::where('id', $data['category'])->firstOrFail();
      $totalAmount = ($subtype->price ?? 0) + ($subtype->commission ?? 0);
    //   $application = Str::uuid();
    $application = 'VISA-' . now()->format('YmdHisv') . '-' . strtoupper(Str::random(4));

  
      $booking = new VisaBooking();
      $booking->origin_id = $data['origin'];
      $booking->destination_id = $data['destination'];
      $booking->visa_id = $data['typeof'];
      $booking->subtype_id = $data['category'];
  
      $booking->user_id = Auth::id(); // Current logged-in user
      $booking->client_id = Auth::id(); // Assuming same as user
      $booking->application_number = $application;
      $booking->total_amount = $totalAmount;
      $booking->dateofentry = $data['dateofentry'];
      $booking->save(); // Save booking first

      $userData = session('user_data');

      DatabaseHelper::setDatabaseConnection($userData['database']);
      
      // $user = User::on('user_database')->where('id', $id)->first();
      $user = User::on('user_database')->where('email', $userData['email'])->first();
    
      if($user->type=="staff"){
          $agency_record=Agency::where('database_name',$userData['database'])->first(); 
          $agency = Agency::with('userAssignments.service')->find($agency_record->id);
      }else{
          $agency_record=Agency::where('email',$user->email)->first(); 
          $agency = Agency::with('userAssignments.service')->find($agency_record->id);
      }
  
  

      // Fetch agency based on the current user
    //   $agency = Agency::where('id', Auth::id())->firstOrFail(); 
      $balance = Balance::where('agency_id', $agency->id)->first();
  
      // If balance record does not exist, return an error
      if (!$balance) {
      
          throw new \Exception('Balance record not found.'); // Exception is better than dd()
      }
  
      $fundRemaining = $balance->balance;
  
      // Check if agency has enough balance
      if ($totalAmount > $fundRemaining) {
        dd('Insufficient balance.');
          throw new \Exception('Insufficient balance.'); // Exception is better than dd()
      }
  
      // Deduct amount from balance first
      $balance->balance -= $totalAmount;
      $balance->save();
  
      // Create deduction record
      $deduction = new Deduction();
      $deduction->agency_id = $agency->id;
      $deduction->service = '3';
      $deduction->invoice_number = $application;
      $deduction->flight_booking_id = $booking->id;
      $deduction->amount = $totalAmount;
      $deduction->date = now();
      $deduction->save();
  
      return $booking; // Return the saved booking object
  }
  
    public function deleteVisa($id)
    {
        return Visa::destroy($id);
    }
}
