<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightSearchRequest extends FormRequest
{
    public function rules(): array
    {
       
        $this->merge([
            'origin' => getAirportCode($this->origin),
            'destination' => getAirportCode($this->destination),
        ]);
        $fields = [
            'origin' => '',
            'destination' => '',
            'departureDate' => 'required|date',
            'type' => 'required|string',
            'cabinClass' => 'required|string',
            'adult' => 'required|integer',
            'child' => 'required|integer',
            'infant' => 'required|integer',
            'currency' => 'required|string',
            'returnDate' => 'required_if:type,return',
            'fareType' => 'required|string|in:PublicFaresOnly,PrivateFaresOnly',
            'flexi' => 'in:0,1',
        ];
        if ($this->type == 'return') {
            $fields['returnDate'] = 'required';
            unset($fields['departureDate']);
        }

        return $fields;
    }

    public function authorize(): bool
    {
        return true;
    }
}
