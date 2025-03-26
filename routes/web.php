<?php

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
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
use App\Http\Controllers\SuperAdmin\TermsConditionController;
use App\Http\Controllers\SuperAdmin\LeaveManagementController;
use App\Http\Controllers\SuperAdmin\AssignmentManagementController;
use App\Http\Controllers\SuperAdmin\VisaController;
use App\Http\Controllers\GloballyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\LogUserActivity;


/******Controler for agencies ***** */
use App\Http\Controllers\AgencyAdmin\AgencyAdminController;
use App\Http\Controllers\AgencyAdmin\AgencyRoleController;
use App\Http\Controllers\AgencyAdmin\AgencyPermissionController;
use App\Http\Middleware\CheckUserSession;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\Agencies\ClientController;





Route::fallback(function() {
    return redirect('/login');
});

Route::get('/test',function (){
    $user = User::find(1);
    if ($user) {
        $user->assignRole('super admin');
        return "User has been assigned Super Admin role.";
       }
});


Route::get('/viewtest',function (){

return view('viewtest');
}); 
Route::post('/search',[GloballyController::class,'hs_globalserach'])->name('search');
Route::get('/login',[AuthController::class,'login_form'])->name('login');
Route::post('/login',[AuthController::class,'superadmin_login'])->name("superadmin_login");
Route::get('/logout',[AuthController::class,'superadmin_logout'])->name("superadmin_logout");
Route::get('/agencylogout',[AuthController::class,'agency_logout'])->name("agency_logout");
Route::get('/getflight',[ServiceController::class,'getflight']);
Route::get('/{d}', [AgencyController::class, 'him_agencylogin']);
// Route::get('/logout',[AuthController::class,'superadmin_logout'])->name("superadmin_logout");
Route::middleware([LogUserActivity::class])->group(function () {


            Route::get('/generate-pdf', [AgencyController::class, 'generatePDF'])->name('generate.pdf');

            /**** Super Admin route ********/
            Route::prefix('super-admin')->middleware(['auth', 'verified'])->group(function () {

                Route::get('/invoice/{invoice_number}', [ServiceController::class, 'hs_generateinvocie'])->name('superadmingenerateInvoice');
                Route::get('/booking/{booking_number}', [ServiceController::class, 'hs_invoice'])->name('superadminbooking');
    
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
                        Route::get('create', 'him_create_agency')->name('create_agency');
                        Route::post('store', 'him_store_agency')->name('agencies.store');
                        Route::get('edit/{id}', 'him_edit_agency')->name('agencies.edit');
                        Route::post('editstore', 'him_editstore')->name('agencies.editstore');
                        Route::get('delete/{id}', 'him_delete_agency')->name('agencies.delete');
                        Route::get('/export-agency','exportAgency')->name('agencies.downloade');
                        Route::get('/generate-pdf',  'generatePDF')->name('agencies.invoice');
                        Route::get('/agency/{id}','hs_agency_hisoty')->name('agencies.history');

                    });


                      /***Route for Leave Managment  ***/
                      Route::controller(LeaveManagementController::class)->group(function () {
                        Route::get('/addleave','hs_addleave')->name('add.leave');
                        Route::post('/leave','hs_leavestore')->name('leavestore');
                        Route::get('/leave/{id}','hs_update')->name('update.leave');
                        Route::post('/updateleave','hs_updatestore')->name('update.leavestore');

                        Route::get('/leaves','hs_leaves')->name('leaves');
                        Route::post('/applyleave_store','hs_applyleave')->name('application_leave');
                        Route::get('/pending_leave','hs_pendingleave')->name('pending.leave');

                        Route::get('/edit_leave/{leaveid}','hs_editleave')->name('leave.edit');
                        Route::get('/cancel_leave/{leaveid}','hs_cancelleave')->name('leave.cancel');

                        
                      });



                        /***Route for Assignment Management  ***/
                        /***Route for Assignment Management  ***/
                        Route::controller(AssignmentManagementController::class)->group(function () {
                            Route::get('/index','hs_index')->name('assignment');
                            Route::post('/assignmentstore','hs_assignment_store')->name('assignment.store');
                            Route::get('/assignedit/{id}','hs_assignment_edit')->name('assign.edit');
                            Route::post('/assigneditstore','hs_assignment_editstore')->name('assign.editstore');
         
                          });
                      


                    /*** Route for staff ***/
                    Route::controller(SuperadminController::class)->group(function () {
                        Route::get('/generate-pdf','generatePDF')->name('studentgenerate.pdf');
                        Route::get('/studentgenerate-pdf', 'generatePDF')->name('studentgenerate.pdf');
                        Route::get('/studnetgenerate-excel','exportStudent')->name('studentgenerate.excel');
                        Route::get('/staffindex', 'hs_staffindex')->name('staff');
                        Route::get('/staffcreate', 'hs_staffcreate')->name('superadmin_staffcreate');
                        Route::post('/staffstore', 'hs_staffstore')->name('superadmin_staffstore');
                        Route::get('/staffupdate/{id}', 'hs_staffupdate')->name('superadmin_staffupdate');
                        Route::post('/staffupdate', 'hs_supdatedstore')->name('hs_supdatedstore');
                        Route::get('/staffdelete/{id}', 'hs_staffdelete')->middleware('can:staff delete')->name('superadmin_staffdelete'); // Fixed incorrect controller method
                        Route::get('/staffDetails/{id}', 'hs_staffDetails')->middleware('can:view staffdetails')->name('superadmin_staffDetails');
                        Route::get('/staff/{id}','hs_staff_hisoty')->name('staff.history');
                        Route::get('/attandance','hs_attendance')->name('attendance');
                        Route::get('/profile','hs_profile')->name('profile');
                        Route::get('/generate','hs_generatesaleryslip')->name('generate.saleryslip');
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



                        /*** Route for Booking and inventory ***/
                    Route::controller(InventoryController::class)->group(function () {
                            Route::get('/inventory', 'hs_inventory')->name('superadmin.inventory');
                            Route::get('/booking','hs_bookingManagment')->name('superadmin.booking');
                            Route::get('/exportbooking','exportBookingsExcel')->name('superadmin.exportexcel');
                            Route::get('/generate-pdf',  'exportBookingsPDF')->name('superadmin.exportpdf');
                            Route::get('/serach','searchFilter')->name('bookings.filter');

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

                // Route::controller(InventoryController::class)->group(function () {
                //     Route::get('inventory', 'hs_inventory')->name('superadmin.inventory');  // Unique path


                // });
                        Route::controller(TermsConditionController::class)->group(function () {
                                Route::get('terms', 'hs_index')->name('superadmin.terms');
                                Route::post('storeterms','hs_store')->name('superadmin.termsstore');  
                                Route::get('term/{id}','hs_edit')->name('superadmin.termedit');  
                                Route::post('editstoreterms','hs_store')->name('superadmin.uptermsstore'); 
                    
                            });

                        Route::controller(VisaController::class)->group(function () {
                                 Route::get('coutnry','hsCountry')->name('view.country');
                                 Route::get('visa','hsVisa')->name('visa.view');
                                 Route::get('visacreate','hsVisacreate')->name('visa.create');
                                 Route::post('visastore','hsStore')->name('visa.store');
                                 Route::get('/visa/assign/{id?}','hsassignVisa')->name('visa.assign');
                                 Route::post('/visa/assignstore','hsassignStore')->name('assignstore');
                                
                                 Route::get('/editvisa/{id}','hseditvisa')->name('visa.edit');
                                 Route::post('/editvisastore','hsestorevisa')->name('visa.editstore');
                                 Route::get('/visacoutnry','hsvisacoutnry')->name('visa.country');
                                 Route::get('/editcoutnry/{id}','hseditvisacoutnry')->name('visa.editcountry');
                                 Route::get('/viewvisacoutnry/{id}','hseditvisacoutnry')->name('visa.assigncountry');
                                 Route::get('/allform','hsFromindex')->name('visa.forms');
                                 Route::post('/formstore','hsFromStore')->name('visaform.store');
                        });

    });

    



});

/****** Route For agency *******/

Route::post('agencies/agencies_store', [AgencyController::class, 'him_agencies_store'])->name('agency_login');



Route::group([
    'prefix' => 'agencies',
    'middleware' => [CheckUserSession::class] // Applying middleware here
], function () {
    // Route::post('agencies_store', [AgencyController::class, 'him_agencies_store'])->name('agency_login');
    Route::get('/dashboard',[AgencyController::class, 'him_agenciesdashboard'])->name('agency_dashboard');
    Route::get('/support',[SupportController::class, 'him_agenciesupport'])->name('agency_support');
    Route::post('/storeticket',[SupportController::class, 'him_storeticket'])->name('store_ticket');
    Route::get('/conversation/{id}', [SupportController::class, 'hs_conversation'])->name('agency.conversation');

    // Service Management
    Route::controller(ServiceController::class)->group(function () {
        Route::get('test', 'him_test')->name('test');
        Route::get('flight', 'him_flight')->name('Flight');
        Route::get('hotel', 'him_hotel')->name('Hotel');
        Route::get('visa', 'him_visa')->name('Visa');
        // Route::post('flight_search','him_flightsearch')->name('flight.search');
        // Route::post('flight_price','him_flightprice')->name('flight.pricing');
        Route::post('/passenger-details', 'passengerDetails')->name('flight.passenger-details');
        Route::post('/payment',  'payment')->name('flight.payment');
        Route::get('/invoice/{invoice_number}','hs_generateinvocie')->name('generateInvoice');
        Route::get('/booking/{booking_number}','hs_invoice')->name('agency_booking');
        Route::get('/airport/{input}', 'airport')->name('search.airport');
    });

    // Staff Management
    Route::controller(AgencyadminController::class)->group(function () {
        Route::get('/staffindex', 'hs_staffindex')->name('agency.staff');
        Route::get('/staffcreate', 'hs_staffcreate')->name('agency_staffcreate');
        Route::post('/staffstore', 'hs_staffstore')->name('agency_staffstore');
        Route::get('/staffupdate/{id}', 'hs_staffupdate')->name('agency_staffupdate');
        Route::post('/staffupdate', 'hs_supdatedstore')->name('hs_agencyudatedstore');
        Route::get('/staffdelete/{id}', 'hs_staffdelete')->middleware('can:staff delete')->name('agency_staffdelete');
        Route::get('/staffDetails/{id}', 'hs_staffDetails')->middleware('can:view staffdetails')->name('agency_staffDetails');
        Route::get('/staff/{id}','hs_staff_hisoty')->name('agencystaff.history');
        Route::get('/attandance','hs_attendance')->name('agency.attendance');
        Route::get('/profile','hs_profile')->name('agency.profile');

    });


    // Visa
    Route::controller(VisaController::class)->group(function () {
        Route::get('/viewapplication/{type}', 'hs_visaApplication')->name('agency.application');
        Route::post('/visasection','hsviewSearchvisa')->name('searchvisa'); 
        Route::get('/payment/{id}','him_payment')->name('visa.payment');
        Route::get('/get-visa-services','him_getService' )->name('get.visa.services');
        Route::post('/visabook','hsVisaBook')->name('visa.book');
        Route::get('/documentpending','hsVisaDocumentpending')->name('visa.documentpending');
        Route::get('/visaview/{id}','hsVisaVisa')->name('visa.applicationview');
        Route::get('/editapplication/{id}','hsEditVisaApplication')->name('visaedit.application');    
        Route::post('/updateapplication','hsupdateapplication')->name('updatevisa.application');
        
        

     
    });

    Route::controller(ClientController::class)->group(function () {
        Route::get('/client','hs_index')->name('client.index');
        Route::post('/clientstore','hs_ClientStore')->name('client.store');
        Route::get('/get-existing-users','hs_getExistingUsers')->name('get.existing.users'); 
        Route::get('/clientcreate','hs_getClientView')->name('client.create');
        Route::get('/updatecreate/{id}','hs_agencyUpdateClient')->name('agencyupdate.client');
        Route::get('/viewclient/{id}','hs_viewAgencyClient')->name('agencyview.client');
        Route::post('/storeclint','hs_storeUpdateAgencyClient')->name('updateclient.store');
        Route::get('/clientgeneratepdf','generatePDF')->name('generateclint.pdf');


        


       
        
          

     
    });

    // Permissions
    Route::controller(AgencyPermissionController::class)->group(function () {
        Route::get('/permission', 'hs_permissionindex')->name('agency.permission');
        Route::post('/permissionstore', 'hs_permissionstore')->name('agency_permissionstore');
        Route::get('/permissiondelete/{id}', 'hs_permissiondelete')->middleware('can:permission delete')->name('agency_permissiondelete');
    });


    Route::group(['prefix' => 'flight', 'controller' => FlightController::class], function () {
        Route::group(['prefix' => 'modal'], function () {
            Route::get('/details', 'detailModal')->name('flight.detail-modal');
        });
    
        Route::get('/details', 'detailModal')->name('flight.detail-modal');
        Route::post('/search', 'search')->name('flight.search');
        Route::get('/search/results', 'results')->name('flight.results');
        Route::post('/pricing', 'pricing')->name('flight.pricing');
    
        Route::get('/pricing', 'pricing')->name('flight.pricing'); // Added name for consistency
        // Route::post('/passenger-details', 'passengerDetails')->name('flight.passenger-details');
        // Route::get('/flight-passenger-details', 'passengerDetailsView')->name('flight.passenger-details.view');
        // Route::post('/payment', 'payment')->name('flight.payment');
    });

        // Roles
        Route::controller(AgencyRoleController::class)->group(function () {
            Route::get('/roleindex', 'hs_roleindex')->name('agency.role');
            Route::post('/rolestore', 'hs_rolestore')->name('agency_rolestore');
            Route::get('/roledelete/{id}', 'hs_roledelete')->name('agency_roledelete');
            Route::get('/permissionassign/{id}', 'hs_permissionassign')->name('agency_permissionassign');
            Route::post('/permissionassign', 'hs_permissioned')->name('agency_assignpermission');
        });


  


});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

require __DIR__.'/agency.php';
