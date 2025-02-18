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





Route::get('/login',function (){
    dd('heelo');
});

Route::get('/generate-pdf', [AgencyController::class, 'generatePDF']);

/**** Super Admin route ********/
Route::prefix('super-admin')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [AuthController::class, 'hs_dashbord'])->name('dashboard');

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
                Route::get('/roledelete/{id}', 'hs_roledelete')->middleware('can:staff view')->name('superadmin_roledelete');
                Route::get('/permissionassign/{id}', 'hs_permissionassign')->middleware('can:role delete')->name('superadmin_permissionassign');
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
                Route::get('/conversation', 'hs_conversation')->name('superadmin.conversation');
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



        });


         // Service  Management
         Route::controller(ServiceController::class)->group(function () {
            Route::get('test', 'him_test')->name('test');  // Unique path
            Route::get('flight', 'him_flight')->name('Flight'); // Unique path
            Route::get('hotel', 'him_hotel')->name('Hotel'); // Unique path
            Route::post('flight_search','him_flightsearch')->name('flight.search');
            Route::post('flight_price','him_flightsearch')->name('flight.pricing');

        });

     Route::controller(InventoryController::class)->group(function () {
        Route::get('inventory', 'hs_inventory')->name('superadmin.inventory');  // Unique path


    });





});


// /route for agency
Route::group(['prefix' => 'agencies'], function () {
       Route::post('agencies_store', [AgencyController::class, 'him_agencies_store'])->name('agency_login');
       Route::get('/dashboard',[AgencyController::class, 'him_agenciesdashboard'])->name('agency_dashboard');
       Route::get('/support',[AgencyController::class, 'him_agenciesupport'])->name('agency_support');

});

Route::get('/{d}', [AgencyController::class, 'him_agencylogin']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
