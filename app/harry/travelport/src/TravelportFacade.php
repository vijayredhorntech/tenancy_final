<?php

namespace App\harry\Travelport\src;


use Illuminate\Support\Facades\Facade;

class TravelportFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Travelport::class;
    }
}
