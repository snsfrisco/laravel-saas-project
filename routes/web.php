<?php

use App\Http\Controllers\AutoCompleteController;
use App\Http\Controllers\Client\ClientUserController;
use App\Http\Controllers\Client\ManageClientRolesController;

use App\Http\Controllers\Company\CompanyUserController;
use App\Http\Controllers\Company\ManageCompanyRolesController;
use App\Http\Controllers\Portal\ManageCompanyController;
use App\Http\Controllers\Portal\ManagePortalRolesController;
use App\Http\Controllers\Portal\PortalUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Company\ClientController;
use App\Http\Controllers\Portal\ManageCompanyAdminsController;
use App\Http\Controllers\StaticFileController;
use App\Mail\TestEmail;
use App\Http\Controllers\Dogs\DogsController;
use App\Http\Controllers\Cats\CatsController;

// use Mail;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
});

include('portal_users_routes.php');
include('applicant_users_routes.php'); */



Route::get('/', function () {
    return view('welcome');
})->name('home');



/***************************************************************************************************************************************************************************************************************************/

/////////////////////////////////////////////////////////////////////// Applicant Users Routes ///////////////////////////////////////////////////////////////////////////////////////////

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



/////////////////////////////////////////////////////////////////////// Applicant Users Routes ///////////////////////////////////////////////////////////////////////////////////////////


/***************************************************************************************************************************************************************************************************************************/

/////////////////////////////////////////////////////////////////////// Portal Users Routes ///////////////////////////////////////////////////////////////////////////////////////////

    Route::prefix('portal-admin')->name('portal_user.')->group(function(){

        Route::get('/', function(){
            return redirect()->route('portal_user.login');
        })->name('home');

        Route::middleware(['guest:portal_user','PreventBackHistory'])->group(function(){
            Route::view('/login','portal_user.login')->name('login');
            Route::post('/check', [PortalUserController::class,'check'])->name('check');
        });

        Route::middleware(['auth:portal_user','PreventBackHistory'])->group(function(){
            Route::view('/dashboard','portal_user.dashboard')->name('dashboard');
            Route::view('/profile','portal_user.dashboard')->name('profile');
            Route::post('/logout', [PortalUserController::class,'logout'])->name('logout');

            Route::resource('roles', ManagePortalRolesController::class);
            Route::resource('users', PortalUserController::class);
            Route::resource('companies', ManageCompanyController::class);
            Route::resource('companies-admins', ManageCompanyAdminsController::class);

        });

    });


/////////////////////////////////////////////////////////////////////// Portal Users Routes End////////////////////////////////////////////////////////////////////////////////////////

/***************************************************************************************************************************************************************************************************************************/

/////////////////////////////////////////////////////////////////////// Company Users Routes //////////////////////////////////////////////////////////////////////////////////////////

    Route::prefix('company-admin')->name('company_user.')->group(function(){

        Route::get('/', function(){
            return redirect()->route('company_user.login');
        })->name('home');

        Route::middleware(['guest:company_user','PreventBackHistory'])->group(function(){
            Route::view('/login','company_user.login')->name('login');
            Route::view('/register','company_user.register')->name('register');
            Route::post('/create', [CompanyUserController::class,'create'])->name('create');
            Route::post('/check', [CompanyUserController::class,'check'])->name('check');
        });

        Route::middleware(['auth:company_user','PreventBackHistory'])->group(function(){
            Route::view('/dashboard','company_user.dashboard')->name('dashboard');
            Route::view('/profile','company_user.dashboard')->name('profile');
            Route::post('/logout', [CompanyUserController::class,'logout'])->name('logout');

            Route::resource('roles', ManageCompanyRolesController::class);
            Route::resource('users', CompanyUserController::class);

		 	Route::resource('clients', ClientController::class);
			Route::get('user/{client_id}', [ClientController::class,'user'])->name('client-user');
			Route::post('user/store', [ClientController::class,'user_store'])->name('client-user-store');
			Route::get('user/edit/{id}', [ClientController::class,'user_edit'])->name('client-edit');
			Route::PUT('user/update/{id}', [ClientController::class,'user_update'])->name('client-update');
			Route::delete('user/destroy/{id}', [ClientController::class,'user_destroy'])->name('client-destroy');
			// Route::resource('client/users', ClientUserController::class);
			//Route::get('/clients', [ClientUserController::class,'index'])->name('clients');
        });

    });

/////////////////////////////////////////////////////////////////////// Company Users Routes End //////////////////////////////////////////////////////////////////////////////////////

/***************************************************************************************************************************************************************************************************************************/

/////////////////////////////////////////////////////////////////////// Client Users Routes ///////////////////////////////////////////////////////////////////////////////////////////

    Route::prefix('client')->name('client_user.')->group(function(){

        Route::middleware(['guest:client_user','PreventBackHistory'])->group(function(){
            Route::view('/login','client_user.login')->name('login');
            Route::view('/register','client_user.register')->name('register');
            Route::post('/create',[ClientUserController::class,'create'])->name('create');
            Route::post('/check',[ClientUserController::class,'check'])->name('check');
        });

        Route::middleware(['auth:client_user','PreventBackHistory'])->group(function(){
            Route::view('/dashboard','client_user.dashboard')->name('dashboard');
            Route::view('/profile','client_user.dashboard')->name('profile');
            Route::post('logout',[ClientUserController::class,'logout'])->name('logout');

            Route::resource('roles', ManageClientRolesController::class);
            Route::resource('users', ClientUserController::class);

            Route::get('search', [AutoCompleteController::class, 'index'])->name('search');
            Route::get('autocomplete', [AutoCompleteController::class, 'autocomplete'])->name('autocomplete');
			Route::get('getdetail', [AutoCompleteController::class, 'getmemberdetail'])->name('getdetail');
        });

    });
    Route::get('/{attachment}/{name}/{id}/{file}', [StaticFileController::class, 'attachment']);
	Route::get('/{upload}/{id}/{file}', [StaticFileController::class, 'loanattachment']);

/////////////////////////////////////////////////////////////////////// Client Users Routes End////////////////////////////////////////////////////////////////////////////////////////

/***************************************************************************************************************************************************************************************************************************/

/////////////////////////////////////////////////////////////////////// Dev Testing Routes ///////////////////////////////////////////////////////////////////////////////////////////

    Route::get('test-email', function(){
        Mail::to('test@test.com')->send(new TestEmail());
    });

/////////////////////////////////////////////////////////////////////// Dev Testing Routes End////////////////////////////////////////////////////////////////////////////////////////

/***************************************************************************************************************************************************************************************************************************/


