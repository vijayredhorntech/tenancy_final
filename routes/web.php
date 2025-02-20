<?php

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\SuperAdmin\AuthController;
use App\Http\Controllers\SuperAdmin\AgencyController;
use App\Http\Controllers\SuperAdmin\SuperadminserviceController;
use App\Http\Controllers\SuperAdmin\SuperadminController;
use App\Http\Controllers\SuperAdmin\RoleController;
use App\Http\Controllers\SuperAdmin\PermissionController;
use App\Http\Controllers\SuperAdmin\FundManagementController;
use App\Http\Controllers\SuperAdmin\ServiceController;
use App\Http\Controllers\SuperAdmin\InventoryController;
use App\Http\Controllers\Agencies\SupportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\LogUserActivity;





Route::fallback(function() {
    return redirect('/login');
});


Route::get('/login',[AuthController::class,'login_form'])->name('login');
Route::post('/login',[AuthController::class,'superadmin_login'])->name("superadmin_login");
Route::get('/logout',[AuthController::class,'superadmin_logout'])->name("superadmin_logout");
Route::get('/invoice',[ServiceController::class,'hs_invoice']);

// Route::get('/logout',[AuthController::class,'superadmin_logout'])->name("superadmin_logout");
Route::middleware([LogUserActivity::class])->group(function () {
  

            Route::get('/generate-pdf', [AgencyController::class, 'generatePDF']);

            /**** Super Admin route ********/
            Route::prefix('super-admin')->middleware(['auth', 'verified'])->group(function () {

                Route::get('/dashboard', [AuthController::class, 'hs_dashbord'])->name('dashboard');

              /*** Service Routes ***/
                Route::controller(SuperadminserviceController::class)->group(function () {
                    Route::get('/serviceindex', 'hs_serviceindex')->name('superadmin_service');
                    Route::post('/sericestore', 'hs_servicestore')->name('superadmin_ servicestore'); // Fixed extra space in name
                    Route::get('/servicecreate', 'hs_servicecreate')->middleware('can:service create')->name('superadmin_servicecreate');
                    Route::get('/serviceupdate/{id}', 'hs_serviceupdate')->middleware('can:service update')->name('superadmin_serviceupdate');
                    Route::post('/serviceupdate_store', 'hs_update_store')->name('serviceupdate_store');
                    Route::get('/servicedelete/{id}', 'hs_servicedelete')->middleware('can:service delete')->name('superadmin_servicedelete');
                });




                /***Route for Agency ***/
                    Route::controller(AgencyController::class)->group(function () {
                        Route::get('/agency','him_agency_index')->name('agency');
                        Route::post('store', 'him_store_agency')->name('agencies.store');
                        Route::get('edit/{id}', 'him_edit_agency')->name('agencies.edit');
                        Route::post('editstore', 'him_editstore')->name('agencies.editstore');
                        Route::get('delete/{id}', 'him_delete_agency')->name('agencies.delete');
                        Route::get('/export-agency','exportAgency')->name('agencies.downloade');
                        Route::get('/generate-pdf',  'generatePDF')->name('agencies.invoice');
                        Route::get('/agency/{id}','hs_agency_hisoty')->name('agencies.history');

                    });


                    /*** Route for staff ***/
                    Route::controller(SuperadminController::class)->group(function () {
                        Route::get('/staffindex', 'hs_staffindex')->name('staff');
                        Route::post('/staffstore', 'hs_staffstore')->name('superadmin_staffstore');
                        Route::get('/staffupdate/{id}', 'hs_staffupdate')->name('superadmin_staffupdate');
                        Route::post('/staffupdate', 'hs_supdatedstore')->name('hs_supdatedstore');
                        Route::get('/staffdelete/{id}', 'hs_staffdelete')->middleware('can:staff delete')->name('superadmin_staffdelete'); // Fixed incorrect controller method
                        Route::get('/staffDetails/{id}', 'hs_staffDetails')->middleware('can:view staffdetails')->name('superadmin_staffDetails');
                    });


                        /*** Route for Roles ***/
                        Route::controller(RoleController::class)->group(function () {
                            Route::get('/roleindex', 'hs_roleindex')->name('superadmin.role');
                            Route::post('/rolestore', 'hs_rolestore')->name('superadmin_rolestore');
                            Route::get('/roledelete/{id}', 'hs_roledelete')->name('superadmin_roledelete');
                            Route::get('/permissionassign/{id}', 'hs_permissionassign')->name('superadmin_permissionassign');
                            Route::post('/permissionassign', 'hs_permissioned')->name('superadmin_assignpermission');
                        });



                        /*** Route for permissions ***/
                    Route::controller(PermissionController::class)->group(function () {
                        Route::get('/permission', 'hs_permissionindex')->name('superadmin.permission');
                        Route::post('/permissionstore', 'hs_permissionstore')->name('superadmin_permissionstore');
                        Route::get('/permissiondelete/{id}', 'hs_permissiondelete')->middleware('can:permission delete')->name('superadmin_permissiondelete');

                    });



                        /*** Route for permissions ***/
                    Route::controller(InventoryController::class)->group(function () {
                            Route::get('/inventory', 'hs_inventory')->name('superadmin.inventory');
                        });
                        /*** Route for conversations ***/
                    Route::controller(ConversationController::class)->group(function () {
                            Route::get('/ticket','hs_viewticket')->name('superadmin.ticket');
                            Route::get('/conversation/{id}', 'hs_conversation')->name('superadmin.conversation');
                            Route::post('/message', 'hs_storeconversation')->name('send_message');
                            
                        });


                    // Fund Management
                    Route::controller(FundManagementController::class)->group(function () {
                        Route::get('fund/{id}', 'him_addfund_agency')->name('agencies.fund');
                        Route::post('storefund', 'him_storefund')->name('agencies.fund.store');

                        Route::get('test', 'him_test')->name('test');  // Unique path
                        Route::get('flight', 'him_test2')->name('Flight'); // Unique path
                        Route::get('hotel', 'him_test3')->name('Hotel'); // Unique path
                        Route::post('deduction','him_deduction')->name('deduction');

                        Route::post('deduction', 'him_deduction')->name('deduction');
                        Route::get('transaction_approvals','him_transaction_approvals')->name('transaction_approvals');
                        Route::get('transaction_update/{id}','him_transaction_update')->name('transaction_update');
                        Route::post('transaction_store','him_transaction_store')->name('transaction_store');
                        Route::get('transaction_delete','him_transaction_delete')->name('transaction_delete');
                
                    });

                Route::controller(InventoryController::class)->group(function () {
                    Route::get('inventory', 'hs_inventory')->name('superadmin.inventory');  // Unique path


                });
  
    });



});

/****** Route For agency *******/

Route::group(['prefix' => 'agencies'], function () {
       Route::post('agencies_store', [AgencyController::class, 'him_agencies_store'])->name('agency_login');
       Route::get('/dashboard',[AgencyController::class, 'him_agenciesdashboard'])->name('agency_dashboard');
       Route::get('/support',[SupportController::class, 'him_agenciesupport'])->name('agency_support');
       Route::post('/storeticket',[SupportController::class, 'him_storeticket'])->name('store_ticket');
       Route::get('/conversation/{id}', [SupportController::class, 'hs_conversation'])->name('agency.conversation');

             
      
         // Service  Management
        Route::controller(ServiceController::class)->group(function () {
                    Route::get('test', 'him_test')->name('test');  // Unique path
                    Route::get('flight', 'him_flight')->name('Flight'); // Unique path
                    Route::get('hotel', 'him_hotel')->name('Hotel'); // Unique path
                    Route::post('flight_search','him_flightsearch')->name('flight.search');
                    Route::post('flight_price','him_flightprice')->name('flight.pricing');
                    Route::post('/passenger-details', 'passengerDetails')->name('flight.passenger-details');
                    Route::post('/payment',  'payment')->name('flight.payment');

                });
       

       

});

Route::get('/{d}', [AgencyController::class, 'him_agencylogin']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
