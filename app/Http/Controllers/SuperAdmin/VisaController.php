<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\VisaRepositoryInterface;
use Illuminate\Http\Request;

class VisaController extends Controller
{
    protected $visaRepository;

    public function __construct(VisaRepositoryInterface $visaRepository)
    {
        $this->visaRepository = $visaRepository;
    }


    /**** Get the coutnry record*** */
    public function hsCountry(){
        
        // get record from the repositories 
        $countries = $this->visaRepository->getAllCountry();
        return view('superadmin.pages.visa.counries', compact('countries'));
    }


    /***View All Visa *****/
    public function hsVisa()
    {
        $allvisa = $this->visaRepository->getAllVisas();
        return view('superadmin.pages.visa.visaindex', compact('allvisa'));
    }



    public function show($id)
    {
        $visa = $this->visaRepository->getVisaById($id);
        return response()->json($visa);
    }


      /***Store Visa Data *****/
    public function hsStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
     

        $visa = $this->visaRepository->createVisa($data);

        return redirect()->route('visa.view')->with('success', 'Visa created successfully');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $visa = $this->visaRepository->updateVisa($id, $data);
        return response()->json($visa);
    }

    public function destroy($id)
    {
        $this->visaRepository->deleteVisa($id);
        return response()->json(['message' => 'Visa deleted successfully']);
    }
}
