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
use App\Http\Controllers\SuperAdmin\TeamController;
use App\Http\Controllers\GloballyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\LogUserActivity;
use App\Http\Controllers\SuperAdmin\HotelSettingsController;
use App\Http\Controllers\SuperAdmin\AccountController;

use App\Http\Controllers\SuperAdmin\SupplierController;
/******Controler for agencies ***** */
use App\Http\Controllers\AgencyAdmin\AgencyAdminController;
use App\Http\Controllers\AgencyAdmin\AgencyRoleController;
use App\Http\Controllers\AgencyAdmin\AgencyPermissionController;
// use App\Http\Middleware\CheckUserSession;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\Agencies\ClientController;
use App\Http\Controllers\Agencies\DocumentController;

/*******Controler for Hotel */

use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ClientLoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\InvoiceController;






use App\Events\MessageSent;



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
    $data = session()->all();
    dd($data);

// return view('viewtest');
}); 

Route::get('/migration',[AgencyAdminController::class,'migration']);

Route::get('/dummy-agencies', [AgencyController::class, 'dummyCreateAgency']);
Route::post('/search',[GloballyController::class,'hs_globalSearch'])->name('search');
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
                        Route::get('/agency','him_agency_index')->middleware('can:agency view')->name('agency');
                         Route::get('create', 'him_create_agency')->middleware('can:agency create')->name('create_agency');
                        Route::post('store', 'him_store_agency')->middleware('can:agency create')->name('agencies.store');
                        Route::get('edit/{id}', 'him_edit_agency')->middleware('can:agency update')->name('agencies.edit');
                        Route::post('editstore', 'him_editstore')->middleware('can:agency update')->name('agencies.editstore');
                        Route::get('delete/{id}', 'him_delete_agency')->middleware('can:agency delete')->name('agencies.delete');
                        Route::get('/export-agency','exportAgency')->middleware('can:agency view')->name('agencies.downloade');
                        Route::get('/agencygeneratenew-pdf',  'generatePDF')->middleware('can:agency view')->name('agencies.invoice');
                        Route::get('/agency/{id}','hs_agency_hisoty')->middleware('can:agency view')->name('agencies.history');
                        Route::get('/deleteagency/{id}','hs_agency_delete')->middleware('can:agency delete')->name('agencies.delete');
                    });



                    Route::controller(TeamController::class)->group(function(){
                      Route::get('/team','hs_teamManagment')->name('teammanagment'); 
                      Route::post('/teamstore','hs_teamStore')->name('superadmin.teamstore'); 
                      Route::get('/addmember/{id}','hs_teamMember')->name('superadmin.teamuser');
                      Route::post('/storemember','hs_teamMemberStore')->name('superadmin.teamstoreupdate');
                      Route::get('/viewmember/{id}','hs_teamMemberView')->name('superadmin.teamuserview');
                    //   Route::get('/delete/{id}','hs_teamMemberDelete')->name('superadmin.teamuserdelete');
                    Route::get('/teamuserdelete/{id}/{teamid}','hs_teamMemberDelete')->name('superadmin.teamuserdelete');

                    });


                      /***Route for Leave Managment  ***/
                      Route::controller(LeaveManagementController::class)->group(function () {
                        Route::get('/addleave','hs_addleave')->name('add.leave');
                        Route::post('/leave','hs_leavestore')->name('leavestore');
                        Route::get('/leave/{id}','hs_update')->name('superadmin.update.leave');
                        Route::get('/updateleave/{id}','hs_actionUpdateLeave')->name('update.leavesuperadmin');

                        Route::post('/updateleave','hs_updatestore')->name('update.leavestore');
                        Route::get('/leaves','hs_leaves')->name('leaves');
                        Route::post('/applyleave_store','hs_applyleave')->name('application_leave');
                        Route::get('/pending_leave','hs_pendingleave')->name('pending.leave');
                        Route::post('/leavestore','hs_LeaveUpdateStore')->name('updateleave');

                     
                        Route::get('/edit_leave/{leaveid}','hs_editleave')->name('leave.edit');
                        Route::get('/cancel_leave/{leaveid}','hs_cancelleave')->name('leave.cancel');

                        
                      });



                        /***Route for Assignment Management  ***/
                        Route::controller(AssignmentManagementController::class)->group(function () {
                            Route::get('/index','hs_index')->name('assignment');
                            Route::post('/assignmentstore','hs_assignment_store')->name('assignment.store');
                            Route::get('/assignedit/{id}','hs_assignment_edit')->name('assign.edit');
                            Route::post('/assigneditstore','hs_assignment_editstore')->name('assign.editstore');
                            Route::get('/staffindex','hs_staffAssigment')->name('admin.staff.assignment');
                            Route::get('/assigneview/{id}','hs_staffAssignmentView')->name('assign.view');
                            
                          });
                      


                    /*** Route for staff ***/
                    Route::controller(SuperadminController::class)->group(function () {
                        // Route::get('/generate-pdf','generatePDF')->name('studentgenerate.pdf');
                        Route::get('/studentgenerate-pdf', 'generatePDF')->middleware('can:student export')->name('studentgenerate.pdf');
                        Route::get('/studnetgenerate-excel','exportStudent')->middleware('can:student export')->name('studentgenerate.excel');
                        Route::get('/staffindex', 'hs_staffindex')->middleware('can:staff view')->name('staff');
                        Route::get('/staffcreate', 'hs_staffcreate')->middleware('can:staff create')->name('superadmin_staffcreate');
                        Route::post('/staffstore', 'hs_staffstore')->middleware('can:staff create')->name('superadmin_staffstore');
                        Route::get('/staffupdate/{id}', 'hs_staffupdate')->middleware('can:staff update')->name('superadmin_staffupdate');
                        Route::post('/staffupdate', 'hs_supdatedstore')->name('hs_supdatedstore');
                        Route::get('/staffdelete/{id}', 'hs_staffdelete')->middleware('can:staff delete')->name('superadmin_staffdelete'); // Fixed incorrect controller method
                        Route::get('/staffDetails/{id}', 'hs_staffDetails')->name('superadmin_staffDetails');
                        Route::get('/staff/{id}','hs_staff_hisoty')->middleware('can:staff view')->name('staff.history');
                        Route::get('/attandance','hs_attendance')->name('attendance');
                        Route::get('/profile','hs_profile')->name('profile');
                        Route::get('/generate','hs_generatesaleryslip')->name('generate.saleryslip');

                        /****Staff attandence *** */
                        Route::get('staffattendance','hs_staffattandance')->middleware('can:staff view')->name('staff.attandance');
                        Route::get('staffwages','hs_staffwages')->middleware('can:staff view')->name('staff.wages');
                        Route::get('/staffattandance/{id}','hsstaffAttendance')->middleware('can:staff view')->name('staff.single.attendance');

                        

                    });


                        /*** Route for Roles ***/
                        Route::controller(RoleController::class)->group(function () {
                            Route::get('/roleindex', 'hs_roleindex')->middleware('can:role view')->name('superadmin.role');
                            Route::post('/rolestore', 'hs_rolestore')->middleware('can:role create')->name('superadmin_rolestore');
                            Route::get('/roledelete/{id}', 'hs_roledelete')->middleware('can:role delete')->name('superadmin_roledelete');
                            Route::get('/permissionassign/{id}', 'hs_permissionassign')->middleware('can:role update')->name('superadmin_permissionassign');
                            Route::post('/permissionassign', 'hs_permissioned')->middleware('can:role update')->name('superadmin_assignpermission');
                        });



                        /*** Route for permissions ***/
                    Route::controller(PermissionController::class)->group(function () {
                        Route::get('/permission', 'hs_permissionindex')->middleware('can:permission view')->name('superadmin.permission');
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


                            /*****Booking Inventory*** */
                            Route::get('flight/booking','hs_flightbooking')->name('flight.booking');
                            Route::get('flight/exportbooking','exportFlightBookingsExcel')->name('superadmin.flightexportexcel');
                            Route::get('flight/generate-pdf',  'exportFlightBookingsPDF')->name('superadmin.flightexportpdf');

                            /*****Hotel Inventory *** */
                            Route::get('hotel/booking','hs_hotelbooking')->name('superadminhotel.booking');
                            Route::get('/exporthotelbooking','exportHotelBookingsExcel')->name('superadmin.hotelexportexcel');
                            Route::get('/hotelgenerate-pdf',  'exportHotelBookingsPDF')->name('superadmin.hotelexportpdf');

                               /*****Visa  Inventory *** */
                               Route::get('visa/booking','hsvisaApplication')->name('superadminvisa.booking');
                            //    Route::get('/exportvisabooking','exportVisaBookingsExcel')->name('superadmin.visaexportexcel');
                            //    Route::get('/visagenerate-pdf',  'exportVisaBookingsPDF')->name('superadmin.visaexportpdf');


                        });

                        /*****Supplier Controller *****/
                        Route::controller(SupplierController::class)->group(function () {
                            Route::get('supplier/flight', 'hs_flightSupplier')->name('superadmin.flight');
                            Route::get('supplier/hotel', 'hs_hotelSupplier')->name('superadmin.hotel');
                            Route::get('pay/supplier/{bookingid}', 'hs_paysupplier')->name('superadmin.paysupplier');
                            Route::get('pay/viewsupplier/{bookingid}', 'hs_viewpaysupplier')->name('superadmin.viewpaysupplier');
                            Route::post('pay/amount/store', 'hs_payamountstore')->name('pay.fund.ammount');                         
                            Route::post('supplierstore', 'hs_supplierstore')->name('superadmin.supplierstore');
                        });
                        
                        /*****AccountController *** */
                        Route::controller(AccountController::class)->group(function () {
                            Route::get('b2b/client', 'hsb2bClient')->name('client.account');
                           
                        });

                        /*** Route for conversations ***/
                    Route::controller(ConversationController::class)->group(function () {
                            Route::get('/ticket','hs_viewticket')->name('superadmin.ticket');
                            Route::get('/conversation/{id}', 'hs_conversation')->name('superadmin.conversation');
                            Route::post('/message', 'hs_storeconversation')->name('send_message');
                            Route::get('/editticket/{id}', 'hs_editConversation')->name('superadmin.editticket'); 
                            Route::post('/updatestore','hs_editStore')->name('uperadmin.ticket'); 
                            // Route::get('/chat/{id}/{token?}', 'hs_chatSAApplication')->name('superadminvisachat.client');
                            Route::get('/chat/{id}/{token?}', 'hs_chatSAApplication')->name('superadminvisachat.client');

                            Route::post('/send', 'hs_sendMessageSAApplication')->name('superadminchat.send_message');
                        });




                    // Fund Management
                    Route::controller(FundManagementController::class)->group(function () {
                        Route::get('fund/{id}', 'him_addfund_agency')->name('agencies.fund');
                        Route::post('storefund', 'him_storefund')->name('agencies.fund.store');
                        Route::get('/export-fund','hsexportFund')->name('agencies.funddownloade');
                        Route::get('/agencygenerate-pdf',  'hsGeneratePDF')->name('agencies.exportfundpdf');
                        
                
                        Route::post('deduction','him_deduction')->name('deduction');

                        Route::post('deduction', 'him_deduction')->name('deduction');
                        Route::get('transaction_approvals','him_transaction_approvals')->name('transaction_approvals');
                        Route::get('transaction_update/{id}','him_transaction_update')->name('transaction_update');
                        Route::get('trans_paymentupdate/{id}','him_transactionPaymentUpdate')->name('transaction_paymentupdate');

                        
                        Route::post('transaction_store','him_transaction_store')->name('transaction_store');
                        Route::get('transaction_delete','him_transaction_delete')->name('transaction_delete');

                    });

                // Route::controller(InventoryController::class)->group(function () {
                //     Route::get('inventory', 'hs_inventory')->name('superadmin.inventory');  // Unique path


                // });
                        Route::controller(TermsConditionController::class)->group(function () {
                               Route::get('termtype', 'hs_termtypeindex')->name('superadmin.termtype');
                                Route::get('terms', 'hs_index')->name('superadmin.terms');
                                Route::get('termscreate/{id}','hs_termscreate')->name('superadmin.addterms');
                                Route::get('viewterm/{id}','hs_viewTerms')->name('superadmin.viewterms');
                    

                                Route::post('storetermtype','hs_termtype_store')->name('superadmin.storetermtype');
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
                                 Route::post('/visa/assignupdatestore','hsassignupdateStore')->name('assignupdatestore');

                                 Route::get('/viewsubtype/{id}','hsViewSubtype')->name('visa.viewsubtype');
                                 Route::get('/viewdelete/{id}','hsViewdelete')->name('visa.delete');
                                 Route::get('/subtypedelete/{id}','hsVisasutypdelete')->name('visasubtype.delete');
                                 Route::get('/subtypeedit/{id}','hseditSubtype')->name('visaedit.subtype');
                                 Route::post('/visa/updatesubtype','hsupdateSubTypeStore')->name('updatesubtype');

                                 Route::get('/requred/{id}','hsrequiredClientFiled')->name('requiredclient.field');
                                 Route::post('/visa/requiredstore','hsrequiredClientFiledStore')->name('superadmin.assignclientfieldcountry');
                                 

                                 

                                
                                 Route::get('/editvisa/{id}','hseditvisa')->name('visa.edit');
                                 Route::post('/editvisastore','hsestorevisa')->name('visa.editstore');
                                 Route::get('/visacoutnry','hsvisacoutnry')->name('visa.country');
                                 Route::get('/editcoutnry/{id}','hseditvisacoutnry')->name('visa.editcountry');
                                 Route::get('/viewvisacoutnry/{id}','hseditvisacoutnry')->name('visa.assigncountry');
                                 Route::get('/allform','hsFromindex')->name('visa.forms');
                                 Route::post('/formstore','hsFromStore')->name('visaform.store');
                                 Route::get('/deleteform/{id}','hsFormDelete')->name('form.delete');
                                 Route::get('/assigncoutnry/{id}','hsAssignCountry')->name('form.assigncountry');
                                 Route::post('/assigncoutnrystore','hsAssignCountrystore')->name('visaform.assigncountry');

                                 Route::get('/viewcoutnry/{id}','hsViewCountry')->name('form.viewform');
                                 Route::get('/disconnectform/{id}','hsFromDisConnectCountry')->name('disconnectform.country'); 
                                 Route::get('/allapplicatoin', 'hs_visaAllApplication')->name('superadminview.allapplication');
                                 Route::get('/editapplicatoin/{id}', 'hs_editSAApplication')->name('superadminvisaedit.application');
                                

                                 Route::get('/sendeail/{id}', 'hs_sendSAApplication')->name('superadminvisasendemail.application');
                                 Route::get('/viewapplication/{id}', 'hs_viewSAApplication')->name('superadminvisa.applicationview');


                                 
                        });
                              /****Document Controller **** */
                         Route::controller(DocumentController::class)->group(function () {
                                /****Visa APplicaton  */
                                Route::post('/documents/store', 'hs_storeDocument')->name('documents.store');
                                Route::get('/adddocument/{id}', 'hs_SAAddDocuments')->name('superadminaad.document.application');
                                Route::get('/client/document/view/{id}', 'hs_SAAViewDocuments')->name('client.document.view');
                                Route::get('/editdocument/{id}', 'hs_editSAUploadedApplication')->name('superadminvisaeditdocument.application');
                                Route::post('/updatedocument', 'hs_storeUpdateDocument')->name('updateclient.document');
                               
                                Route::get('/document/application/{id}','hsshowUploadForm')->name('superadminaad.document.upload');
                                Route::post('/document/upload','hsuploadDocument')->name('upload.document');
                                Route::get('/clientupload/documentdelete/{id}/{bookingid}','hsdocuemntdestroy')->name('clientupload.documentdelete');
                                // Route::get('/document/download/{filename}', 'downloadDocument')->name('document.download');

                            
                            });


                        Route::controller(HotelSettingsController::class)->group(function () {
                            Route::get('/suppliersetting', 'hs_hotelsupplier')->name('supplier.hotel');
                        });

                        Route::controller(NotificationController::class)->group(function () {
                            Route::get('/notification', 'hs_indexNotificationAll')->name('notification.index');
                            Route::get('/notifications/view/{id}', 'hsviewNotification')->name('notifications.view');
                            Route::post('/notifications/assign/{id}', 'hsAssignNotification')->name('notifications.assign');
                            Route::post('/notifications/assign/user', 'hsAssignUser')->name('assign.user');

                        });


                        /*****Invoice and atoll **** */

                    Route::controller(InvoiceController::class)->group(function () {
                        Route::get('/cencelinvoice','hs_SAcancelInvoice')->name('superadmin.cancelinvoice');
                        Route::get('/cencelinvoice/{id}','hs_SAcanceleditInvoice')->name('cancelinvoice.edit');
                        Route::post('/cencelstore  invoice','hsSAupdateinvoice')->name('superadmin.update.cancelinvoice');

                       

                     
                    });

   });

    



});

/****** Route For agency *******/


/*****Client  */
/*****Common Route ***** */



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

require __DIR__.'/agency.php';
