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
use App\Http\Controllers\SuperAdmin\SupplierController;


/******Controler for agencies ***** */
use App\Http\Controllers\AgencyAdmin\AgencyAdminController;
use App\Http\Controllers\AgencyAdmin\AgencyRoleController;
use App\Http\Controllers\AgencyAdmin\AgencyPermissionController;
use App\Http\Middleware\CheckUserSession;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\Agencies\ClientController;
use App\Http\Controllers\Agencies\DocumentController;
use App\Http\Controllers\DocumentSignController;
/*******Controler for Hotel */

use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ClientLoginController;
use App\Http\Controllers\InvoiceController;

use App\Events\MessageSent;


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
/*****Fund Managment *** */

      Route::controller(FundManagementController::class)->group(function () {
            Route::get('/requestfund','hsrequestFund')->name('agency.addfund');
            Route::get('/requestfundapply','hsrequestFundApply')->name('agency.requestfund');
            Route::post('/fundappystore','hsFundApplyStore')->name('agencies.fund.request');
      });
    // Staff Management
      Route::controller(AgencyadminController::class)->group(function () {
         Route::get('/staffindex', 'hs_staffindex')->name('agency.staff');
        Route::get('/staffcreate', 'hs_staffcreate')->name('agency_staffcreate');
        Route::post('/staffstore', 'hs_staffstore')->name('agency_staffstore');
        Route::get('/staffupdate/{id}', 'hs_staffupdate')->name('agency_staffupdate');
        Route::post('/staffupdate', 'hs_supdatedstore')->name('agency.staffupdatestore');

        Route::get('/staffdelete/{id}', 'hs_staffdelete')->middleware('can:staff delete')->name('agency_staffdelete');
        Route::get('/staffDetails/{id}', 'hs_staffDetails')->middleware('can:view staffdetails')->name('agency_staffDetails');
        Route::get('/staff/{id}','hs_staff_hisoty')->name('agencystaff.history');
        Route::get('/attandance','hs_attendance')->name('agency.attendance');
        Route::get('/profile','hs_profile')->name('agency.profile');

        /*****Staff Attendance *** */
        Route::get('staffattendance','hs_staffattandance')->name('agency.staff.attandance');
        Route::get('staffwages','hs_staffwages')->name('agency.staff.wages');
        Route::get('/staffattandance/{id}','hsstaffAttendance')->name('agency.single.attendance');

      });

      /****Leave Manangment *** */
      Route::controller(LeaveManagementController::class)->group(function () {
        Route::get('{type?}/addleave','hs_addleave')->name('add.agency.leave');
        Route::post('/leave','hs_leavestore')->name('agency.leavestore');
        Route::get('/leave/{id}/{type?}','hs_update')->name('agency.update.leave');
        Route::get('/updateleave/{id}','hs_actionUpdateLeave')->name('update.leavesuperadmin');

        Route::post('/updateleave','hs_updatestore')->name('agency.update.leavestore');
        Route::get('/{type?}/leaves','hs_leaves')->name('agecy.leaves');
        Route::post('{type?}/applyleave_store','hs_applyleave')->name('agency.application_leave');
        Route::get('{type?}/pending_leave','hs_pendingleave')->name('agency.pending.leave');
        Route::post('/leavestore','hs_LeaveUpdateStore')->name('updateleave');

     
        Route::get('/edit_leave/{leaveid}','hs_editleave')->name('leave.edit');
        Route::get('/cancel_leave/{leaveid}','hs_cancelleave')->name('leave.cancel');

        
      });



    // Visa
      Route::controller(VisaController::class)->group(function () {
        
        Route::get('/viewapplication/{type}', 'hs_visaApplication')->name('agency.application');
        Route::post('/visasection','hsviewSearchvisa')->name('searchvisa'); 
        Route::get('/payment/{id}','him_payment')->name('visa.payment');
        Route::get('/get-visa-services','him_getService' )->name('get.visa.services');
        Route::post('/visabook','hsVisaBook')->name('visa.book');
        Route::get('/verifyapplication/{id}','hs_verifyapplication')->name('verify.application');
        Route::post('visapayment/{id}','him_visaApplicationPay')->name('visaapplication.pay');


        Route::get('/documentpending','hsVisaDocumentpending')->name('visa.documentpending');
        Route::get('/visaview/{id}','hsVisaVisa')->name('visa.applicationview');
        Route::get('/editapplication/{id}','hsEditVisaApplication')->name('visaedit.application');    
        // Route::post('/updateapplication','hsupdateapplication')->name('updatevisa.application');
        Route::get('/exportpdf', 'hsexportPdf')->name('exportpdf.application');
        Route::get('/exportexcel', 'hsexportExcel')->name('exportexcel.application');
        // Route::get('/view/form/{viewid}/{id}', 'viewForm')->name('view.form');
        Route::get('/preparedemail/{id}', 'hsPreparedEmail')->name('visasendemail.application');
        Route::post('/sendemail','hsSendEmail')->name('sendclintemail');
        Route::get('/sendadmin/{id}', 'hsSendAdmin')->name('visa.sendtoadmin');
        Route::get('/deleteapplication/{id}', 'hsDeleteApllication')->name('delete.application');
        
      });

   /****Client Controller **** */
    Route::controller(ClientController::class)->group(function () {
        Route::get('/client','hs_index')->name('client.index');
        // Route::post('/clientstore','hs_ClientStore')->name('client.store');
        Route::get('/get-existing-users','hs_getExistingUsers')->name('get.existing.users'); 
        Route::get('/clientcreate','hs_getClientView')->name('client.create');
        Route::get('/updatecreate/{id}','hs_agencyUpdateClient')->name('agencyupdate.client');
        Route::get('/message/{id}','hs_agencyChatClient')->name('agencychat.client');
        Route::post('/store','hs_agencyChatStore')->name('agency.send_message');


        Route::get('/viewclient/{id}','hs_viewAgencyClient')->name('agencyview.client');
        Route::post('/storeclint','hs_storeUpdateAgencyClient')->name('updateclient.store');
        Route::get('/clientgeneratepdf','generatePDF')->name('generateclint.pdf');
        Route::get('/clintgenerateexcel','exportAgency')->name('exportclint');
        Route::get('/deleteclient/{id}','hs_deleteAgencyClient')->name('agency.clientdelete');
    });

       /****Document Controller **** */
       Route::controller(DocumentController::class)->group(function () {
           Route::get('docsign','him_docsign')->name('document.create');
           Route::get('/document','hs_docIndex')->name('Doc Sign');
           Route::post('/documentcreate','hs_docCreate')->name('create.document');
           Route::get('/senddocument.email/{id}','hs_sendDocumentEmail')->name('senddocument.email');

           /****Agency */
           Route::get('/client/application','hsClientApplication')->name('agency.notification');
           Route::get('/download/center','hsDownloadDocumentCenter')->name('agency.document.download');

          
      
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


    
            Route::prefix('hotel')->group(function () {

                // SearchController Routes
                Route::controller(SearchController::class)->group(function () {
                    Route::get('/search', 'index')->name('hotel.search');
                    Route::get('/search-results', 'results')->name('hotel.search.results');
                    Route::get('/hotel-details', 'details')->name('hotel.details');
                    Route::get('/holidayList', 'hotelResults')->name('hotel.holidayList');
                    Route::get('/searchHotelByName', 'searchHotel')->name('hotel.searchHotelByName');
                    Route::post('/morefilter', 'moreFilterHotel')->name('hotel.filterHotel');
                    Route::post('/rating', 'HotelRatings')->name('hotel.rating');
                    Route::post('/priceRange', 'filterByPriceRange')->name('hotel.filterHotelByPrice');
                    Route::post('/sortby', 'sortBy')->name('hotel.sort');
                    Route::get('/resetfilter', 'resetFilter')->name('hotel.resetFilter');
                    Route::get('/applyfilter', 'applyFilter')->name('applyFilters');
                    Route::get('/removefilter', 'removeFilter')->name('hotel.removeFilter');
                    Route::get('/suggestions', 'getHotelSuggestions')->name('hotel.suggestions');
                    Route::get('/hotel/details','getHotelDetails')->name('hotel.getDetails');
                    Route::get('/hotel/reset','hsresetFliter')->name('resetFilters');

                    // Route::get('/apply-filters', [FilterController::class, 'applyFilters'])->name('applyFilters');


                });



                // BookingController Routes
                Route::controller(BookingController::class)->group(function () {
                    Route::get('/booking', 'index')->name('hotel.booking');
                    Route::get('/bookingStage1/{bookingDetails}', 'bookingStage1')->name('hotel.bookingStage1');
                    Route::post('/bookingStage2', 'bookingStage2')->name('hotel.bookingStage2');
                    Route::post('/bookingStage3', 'bookingStage3')->name('hotel.bookingStage3');
                    Route::get('/cardPayment/bookingStage4', 'bookingStage4')->name('hotel.bookingStage4');
                    Route::get('/bookingStage5/payment', 'cardPayment')->name('hotel.cardPayment');
                });

                // HotelController Routes
                Route::controller(HotelController::class)->group(function () {
                    Route::get('/roomDetailsPdf/{hotelId}', 'roomDetaiPdf')->name('hotel.roomDetailsPdf');
                    Route::get('/sharePdf/{hotelId}', 'sharePdf')->name('hotel.sharePdf');
                });

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

/****Agency Client Create Form **** */
/****Client Controller **** */
Route::controller(ClientLoginController::class)->group(function () {
      
    Route::get('/{d}/clientlogin','hsClientLogin')->name('client.login');
    Route::post('/clientlogin','hsClientLoginStore')->name('clientloginstore');
    Route::get('/client/application','hsClientApplication')->name('client.application');
    Route::get('/client/profile','hsClientProfile')->name('client.profile');
    Route::get('/client/support','hsClientSupport')->name('client.support');
    Route::get('/client/notification','hsClientNotification')->name('client.notification');
    Route::post('/client/store/','hsClientStoreMessage')->name('client.send_message');
    // Route::get('{type}/uploade/document/{id}','hsClientUploadDocument')->name('clientuplaode.document');
    Route::get('{id}/{type?}/uploade/document', 'hsClientUploadDocument')->name('clientuplaode.document');

    Route::post('/uploade/{store?}','hsClientStoreDocument')->name('client.document.upload');
    Route::get('/download/center','hsDownloadDocumentCenter')->name('client.document.download');
    // Route::get('/{type}/document/download/{id}', 'hsdownloadDocument')->name('clientupload.documentdownload');
    Route::get('/{type?}/document/download/{id}', 'hsdownloadDocument')->name('clientupload.documentdownload');

    Route::get('/clientupload/document/download', 'downloadJsonDocument')->name('clientupload.documentdownloadjson');



 

    Route::get('/client/logout','hsClientLogout')->name('client.logout');
    Route::get('/client/visa','hsClientVisa')->name('client.visa');
    Route::get('/client/visa/{id}','hsClientVisaDetails')->name('client.visa.details');
    
  
});



 /****Client Controller **** */
 Route::controller(ClientController::class)->group(function () {
      
  
    Route::get('/agencies/clientcreate/{token}','hsClientCreate');
    Route::post('/agencies/clientstore','hs_ClientStore')->name('client.store');
    Route::post('/agencies/clientstoreajax','hs_ClientStoreAjax')->name('client.update');
  
    
  
});



/*******Common Route **** */
Route::controller(VisaController::class)->group(function () {
        Route::post('/updateapplication','hsupdateapplication')->name('updatevisa.application');
        Route::get('/view/form/{viewid}/{id}', 'viewForm')->name('view.form');
        Route::get('/fillapplication/{id}/{token}','hsfillApplication')->name('application.client');
        Route::get('verifyapplication/{id}/{type}', 'hs_veriryvisaapplication')->name('verifyvisa.application');
        Route::get('/download-fill-application/{id}', 'hs_')->name('download.fillapplication');
        

        Route::post('/agencies/visastoretoreajax','hs_VisaStoreAjax')->name('visadocument.update');

        Route::post('/confirmapplication','hsconfirmApplication')->name('comfirm.application');

        
});

          Route::controller(InventoryController::class)->group(function () {
                   Route::get('/visa/exportvisabooking','exportVisaBookingsExcel')->name('superadmin.visaexportexcel');
                 Route::get('/visa/visagenerate-pdf',  'exportVisaBookingsPDF')->name('superadmin.visaexportpdf');
                          
          });

 



Route::controller(InvoiceController::class)->group(function () {
    Route::get('{type}/invoice', 'hs_invoice')->name('invoice.index');
    Route::get('/invoice/view/{id}', 'hs_viewInvoice')->name('invoice.view');
    Route::post('agency/amount/store', 'hs_payamountstore')->name('agencypay.invoice.ammount');   
    Route::get('agency/cancel', 'hs_cancelInvoice')->name('agencypay.invoice.cancel');   
    Route::post('generateinvoice', 'hsGenerateInvoice')->name('generateinvoice');
    Route::get('/{type}/invoice', 'hsAllinvoice')->name('invoice.all');
    Route::get('/viewinvoice/{id}','hsviewInvoice')->name('viewinvoice');
    
});


Route::controller(DocumentSignController::class)->group(function () {
    Route::get('generateinvoice/{id}/{type}', 'hs_generateInvoice')
         ->name('send.docsign');

 
});
