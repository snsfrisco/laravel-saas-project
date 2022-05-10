<?php

use App\Http\Controllers\Client\API\ {
    BaseController,
    DashboardController,
    LoginController,
    ManageLoansAPIController,
    ManageMembersAPIController,
    ManageCustomersAPIController
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->middleware(['cors'])->group(function (){

    Route::post('login', [LoginController::class, 'login']);//->middleware(['guest:client_user','PreventBackHistory']);

    Route::middleware('auth:sanctum')->group( function () {
        Route::post('change-password', [LoginController::class, 'change_password']);

        Route::get('states', [BaseController::class, 'states']);
        Route::get('goldrate', [BaseController::class, 'goldrate']);
        Route::get('zones', [BaseController::class, 'client_zones']);
        Route::get('regions', [BaseController::class, 'client_regions']);
        Route::get('branches', [BaseController::class, 'client_branches']);
        Route::get('branches-list', [BaseController::class, 'branches']);
        Route::get('profile', [BaseController::class, 'client_profile']);
        Route::get('dashboard', [DashboardController::class, 'dashboard']);

        Route::apiResource('members', ManageMembersAPIController::class)->except(['update']);
		Route::post('members/{member}', [ManageMembersAPIController::class, 'update'])->name('members.update');
        Route::get('members/{member}/generate_loan_account_no', [ManageMembersAPIController::class, 'generate_loan_account_no']);
        Route::get('members/search/{branch}/{param}', [ManageMembersAPIController::class, 'search']);
        Route::apiResource('customers', ManageCustomersAPIController::class)->except(['update']);
		Route::post('customers/{customer}', [ManageCustomersAPIController::class, 'update'])->name('customer.update');
        Route::get('customers/{customer}/generate_loan_account_no', [ManageCustomersAPIController::class, 'generate_loan_account_no']);
        Route::get('customers/search/{branch}/{param}', [ManageCustomersAPIController::class, 'search']);
        Route::apiResource('loans', ManageLoansAPIController::class)->except(['update']);
        Route::post('loans/{loan}', [ManageLoansAPIController::class, 'update'])->name('loan.update');
        Route::put('loans/{loan}/update_loan_status', [ ManageLoansAPIController::class, 'update_loan_status' ]);
        Route::get('loans/{loan}/loan_emis', [ ManageLoansAPIController::class, 'loan_emis' ]);
    });

});


