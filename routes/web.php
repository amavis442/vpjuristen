<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['namespace' => 'Frontend', 'prefix' => 'registratie', 'middleware' => ['web', 'guest']], function () {
    // Controllers Within The "App\Http\Controllers\Frontend" Namespace
    Route::get('/', 'ClientController@create')->name('frontend.register.client.create');
    Route::post('store', 'ClientController@store')->name('frontend.register.client.store');
    Route::get('debtor', 'DebtorController@create')->name('frontend.register.debtor.create');
    Route::post('debtor/store', 'DebtorController@store')->name('frontend.register.debtor.store');
    Route::get('dossier', 'DossierController@create')->name('frontend.register.dossier.create');
    Route::post('dossier/store', 'DossierController@store')->name('frontend.register.dossier.store');
    Route::get('dossier/thankyou', 'DossierController@thankyou')->name('frontend.register.thankyou');
});


Route::get('/login', 'Dashboard\LoginController@login')->name('dashboard.login')->middleware(['web', 'guest']);
Route::get('/dashboard/login/client', 'Dashboard\LoginClientController@showLoginForm')->name('dashboard.login.client');
Route::get('/dashboard/login/debtor', 'Dashboard\LoginDebtorController@showLoginForm')->name('dashboard.login.debtor');

Route::post('/dashboard/login/client', 'Dashboard\LoginClientController@login');
Route::post('/dashboard/login/debtor', 'Dashboard\LoginDebtorController@validate');



Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', 'DossierController@index')->name('dashboard');

    Route::get('dossier/view', 'DossierController@index')->name('dashboard.dossier.list');
    Route::get('dossier/create', 'DossierController@create')->name('dashboard.dossier.create');
});

