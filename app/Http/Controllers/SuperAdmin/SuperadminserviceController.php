<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Service;

class SuperadminserviceController extends Controller
{

    

    public function hs_serviceindex(){
        
        $id = Auth::user()->id;
        $user = User::find($id);
        $service=Service::get();
        return view('auth.admin.pages.service.service', ['user_data' => $user,'services' => $service]);
    }

      /** Form create for serice **/
    public function hs_servicecreate(){
       
        $id = Auth::user()->id;
        $user = User::find($id);
        $service=Service::get();
        return view('auth.admin.pages.service.service_form', ['user_data' => $user,'services' => $service]);
    }


     /** Store Service **/
    public function hs_servicestore(Request $request)
            {
                $validated = $request->validate([
                    'service_name' => 'required|string|max:255',
                    
                ]);

                $service = new Service();
                $service->name = $request->service_name;
                $service->icon = $request->icon; // Corrected from $request->service_name to $request->icon
                $service->description = $request->description;

                if ($service->save()) {
                    return redirect()->route('superadmin_service')->with('success', 'Service created successfully.');
                } else {
                    return redirect()->route('superadmin_service')->with('error', 'Failed to create service.');
                }
            }

    /** Store update **/
    public function hs_serviceupdate($id)
        {
             $service = Service::find($id);
             $all_service=Service::get();
             $id = Auth::user()->id;
             $user = User::find($id);

            if (!$service) {
               return redirect()->route('superadmin_service')->with('error', 'Service not found.');
                }              
                        return view('auth.admin.pages.service.service_form',['services'=>$all_service,'service'=>$service,'user_data' => $user]);
        }


        /** Store Delete **/              
                    public function hs_servicedelete($id)
                         {
                           $service = Service::find($id);
                           if ($service) {
                           $service->delete();
                            return redirect()->route('superadmin_service')->with('success', 'Service deleted successfully.');
                            } else {
                             return redirect()->route('superadmin_service')->with('error', 'Service not found.');
                           }}

        /*** Store update service***/

        public function hs_update_store(Request $request){
                    $validated = $request->validate([
                        'service_name' => 'string|max:255',
                        'description' => 'string',
                        'id' => 'required|string',
                       
                    ]);
                    
                    // echo $request->id; 
                    $service = Service::where('id',$request->id)->first(); 
                    $service->name = $request->service_name;
                    // $service->icon = $request->icon; // Corrected from $request->service_name to $request->icon
                    $service->description = $request->description;
                    $service->save(); 
    
                    if ($service->save()) {
                        return redirect()->route('superadmin_service')->with('success', 'Service Update successfully.');
                    } else {
                        return redirect()->route('superadmin_service')->with('error', 'Failed to create service.');
                    }
      
        }

        public function hs_flight (Request $request){

            $id = Auth::user()->id;
            $user = User::find($id);
            $service=Service::get();

            return view('auth.admin.pages.service.flight',['user_data' => $user,'services' => $service]);
        }
           



}


