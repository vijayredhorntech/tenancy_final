<?php

namespace App\Livewire\Visa;

use Livewire\Component;
use App\Models\VisaSubtype;
use App\Models\Agency;

use App\Models\RequestApplication; 


class VisaPriceSection extends Component
{
    public $visas;
    public $status;
    public $visaSubtype = [];
    public $origin;
    public $destination;
    public $visaTypes = [];
    // public $processingTimes = [];
    public $processingTimes = '';
    public $selectedVisaCategory = null;
    public $selectedVisaType = null;
    public $selectedProcessingTime = null;
    public $priceDetails = [
        'visa_fee' => 0,
        'service_fee' => 0,
        'tax' => 0,
        'total' => 0
    ];
    
    // Client form fields
    public $firstName = '';
    public $lastName = '';
    public $email = '';
    public $phoneNumber = '';
    public $nationality = '';
    public $zipCode = '';
    public $address = '';
    public $city = '';
    public $dateOfEntry = '';
    // public $processingTimes = '';

    protected $listeners = ['updatePriceDetails' => 'calculatePrice'];

    public function mount($visas, $status)
    {

        $this->visas = $visas;
        // dd($this->visas);
        $this->status = $status;

        if (!empty($this->visas)) {
            $this->origin = $visas[0]->origin;
            $this->destination = $visas[0]->destination;
            $this->visaSubtype = $visas[0]->Subvisas ?? [];
            
            
            // Initialize with first visa category if available
            if (count($this->visas)) {
                $this->selectedVisaCategory = $this->visas[0]->id ?? null;
                $this->updatedSelectedVisaCategory($this->selectedVisaCategory);
                
            }
            
        }
    }

    public function updatedSelectedVisaCategory($categoryId)
    {
        $this->visaTypes = VisaSubtype::where('country_type_id', $categoryId)
            ->get()
            
            
            ->map(function ($type) {
                return [
                    'id' => $type->id,
                    'name' => $type->name,
                    'processing_time' => $type->processing,
                    'price' => $type->price,
                    'commission' => $type->commission,
                    'gstin' => $type->gstin
           
                ];
            });

        dd($this->visaTypes);

        // Reset dependent selections
        $this->selectedVisaType = null;
        $this->selectedProcessingTime = null;
        $this->resetPriceDetails();
    }

   public function saveClient()
{
    $this->validate([
        'selectedVisaCategory' => 'required',
        'selectedVisaType'     => 'required',
        'firstName'            => 'required|string|max:255',
        'lastName'             => 'required|string|max:255',
        'email'                => 'required|email|max:255',
        'phoneNumber'          => 'required|string|max:20',
        'nationality'          => 'required|string|max:255',
        'address'              => 'required|string|max:500',
        'city'                 => 'required|string|max:255',
        'dateOfEntry'          => 'required|date',
    ]);

    // dd("heelo");
    $allSessionData = session()->all();
    // Agency::where('',$allSessionData['agency_domain'])->first(); 
    $agencyData = Agency::with('domains')
    ->whereHas('domains', function ($query) use ($allSessionData) {
        $query->where('domain_name', $allSessionData['agency_domain']);
    })
    ->first();

    $data = [
        'service_type'  => 'Visa',
        'agency_id'     => $agencyData->id ?? null,
        'country_id'    => $this->visas[0]->id ?? 0,
        'visa_id'       => $this->selectedVisaCategory,
        'visa_subtype'=> $this->selectedVisaType,
        'first_name'    => $this->firstName,
        'last_name'     => $this->lastName,
        'full_name'     => $this->firstName . ' ' . $this->lastName,
        'email'         => $this->email,
        'phone_number'  => $this->phoneNumber,
        'nationality'   => $this->nationality,
        'zipcode'       => $this->zipCode,
        'address'       => $this->address,
        'city'          => $this->city,
        'date_of_entry' => $this->dateOfEntry,
        'status'        => 'pending',
    ];

    // dd($data);
    RequestApplication::create($data);


    $this->reset(); // Clears form fields
    return redirect()->route('visa.thank-you');
}



public function updatedSelectedVisaType($visaTypeId)
{
    $selectedType = collect($this->visaTypes)->firstWhere('id', $visaTypeId);


    if ($selectedType) {
        // If processing_time is an array, pick the first one
 $this->processingTimes = $selectedType['processing_time'];
      
        $this->priceDetails = [
            'visa_fee' => $selectedType['price'],
            'service_fee' => $selectedType['commission'],
            'tax' => $selectedType['gstin'],
            'total' => $selectedType['price'] + $selectedType['commission'] + $selectedType['gstin']
        ];
    } else {
        $this->resetPriceDetails();
    }
}

    public function updatedSelectedProcessingTime($processingTime)
    {
        // You can add logic here to handle processing time changes if needed
    }

    private function resetPriceDetails()
    {
        $this->priceDetails = [
            'visa_fee' => 0,
            'service_fee' => 0,
            'tax' => 0,
            'total' => 0
        ];
    }

    public function calculatePrice($details)
    {
        $this->priceDetails = $details;
    }



    public function render()
    {
        return view('livewire.visa.visa-price-section', [
            'priceDetails' => $this->priceDetails
        ]);
    }
}