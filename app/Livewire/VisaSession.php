<?php

namespace App\Livewire;

use Livewire\Component;

class VisaSession extends Component
{
    
    public  $visas=[];
    public $visaSubtype=[]; 
    public $visaProcessing=[]; 

    public function mount(){
      
        $this->visaSubtype = $this->visas->flatMap(function ($visa) {
            return $visa->Subvisas; // returns all subvisas from all visas
        });
        $this->visaProcessing = $this->visas->flatMap(function ($visa) {
            return $visa->Subvisas; // returns all subvisas from all visas
        });

    }
    public function render()
    {
        return view('livewire.visa-session', [
            'visas' => $this->visas
           
        ]);
    }
}
