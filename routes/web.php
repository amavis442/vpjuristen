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

Route::group(['namespace' => 'Frontend', 'prefix' => 'registratie'], function () {
    // Controllers Within The "App\Http\Controllers\Frontend" Namespace
    Route::get('/', 'ClientController@create')->name('frontend.register.client.create');
    Route::post('store', 'ClientController@store')->name('frontend.register.client.store');
    Route::get('debtor', 'DebtorController@create')->name('frontend.register.debtor.create');
    Route::post('debtor/store', 'DebtorController@store')->name('frontend.register.debtor.store');
    Route::get('dossier', 'DossierController@create')->name('frontend.register.dossier.create');
    Route::post('dossier/store', 'DossierController@store')->name('frontend.register.dossier.store');
    Route::get('dossier/thankyou', 'DossierController@thankyou')->name('frontend.register.thankyou');
});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('dossier/view', 'Common\DossierController@view')->name('admin.dossier.list');
    Route::get('dossier/create', 'Common\DossierController@create')->name('admin.dossier.create');
});

