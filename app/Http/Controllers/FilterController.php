<?php

namespace App\Http\Controllers;

use App\Services\FilterService;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    protected $filterService;

    public function __construct(FilterService $filterService)
    {

        $this->filterService = $filterService;

    }

    public function filterApply($hotelData, $filterLists)
                                                               //$hotelData=$availableHotels
    {

        foreach ($filterLists as $filterListKey => $filterListValue) {


            if ($filterListKey == 'ratings') {
                if (session()->has('returnFilteredHotels') && !empty(session('returnFilteredHotels'))) {

                    $this->returnFilteredHotels = session()->get('returnFilteredHotels');


                } else {

                    $this->returnFilteredHotels = $hotelData;

                }

                $FilteredHotels = $this->filterService->ratingFilter($this->returnFilteredHotels, $filterListValue);

                session()->put('returnFilteredHotels', $FilteredHotels);


            }
            if ($filterListKey == 'property_name') {
                if (session()->has('returnFilteredHotels') && !empty(session('returnFilteredHotels'))) {

                    $this->returnFilteredHotels = session()->get('returnFilteredHotels');

                } else {

                    $this->returnFilteredHotels = $hotelData;

                }

                $FilteredHotels = $this->filterService->propertyNameFilter($this->returnFilteredHotels, $filterListValue);

                session()->put('returnFilteredHotels', $FilteredHotels);


            }
            if ($filterListKey == 'budget_range') {
                if (session()->has('returnFilteredHotels') && !empty(session('returnFilteredHotels'))) {

                    $this->returnFilteredHotels = session()->get('returnFilteredHotels');


                } else {

                    $this->returnFilteredHotels = $hotelData;

                }

                $FilteredHotels = $this->filterService->budgetRangeFilter($this->returnFilteredHotels, $filterListValue);

                session()->put('returnFilteredHotels', $FilteredHotels);


            }
            if ($filterListKey == 'sortBy') {
                if (session()->has('returnFilteredHotels') && !empty(session('returnFilteredHotels'))) {

                    $this->returnFilteredHotels = session()->get('returnFilteredHotels');


                } else {

                    $this->returnFilteredHotels = $hotelData;

                }

                $FilteredHotels = $this->filterService->sortByFilter($this->returnFilteredHotels, $filterListValue);

                session()->put('returnFilteredHotels', $FilteredHotels);


            }
            if ($filterListKey == 'boardTypes') {

                if (session()->has('returnFilteredHotels') && !empty(session('returnFilteredHotels'))) {


                    $this->returnFilteredHotels = session()->get('returnFilteredHotels');
                } else {

                    $this->returnFilteredHotels = $hotelData;
                }


                $FilteredHotels = $this->filterService->boardTypeFilter($this->returnFilteredHotels, $filterListValue);
                session()->put('returnFilteredHotels', $FilteredHotels);
                $this->returnFilteredHotels = session()->get('returnFilteredHotels');

            }
        }


        $returnData = session()->get('returnFilteredHotels');
        return $returnData;


    }
}
