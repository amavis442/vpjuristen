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

// Client Frontend maybe put these in a group.
Route::get('/aanmelding/', 'Frontend\ClientController@create')->name('client-create');
Route::post('/aanmelding/store', 'Frontend\ClientController@store')->name('client-store');

Route::get('/aanmelding/debtor', 'Frontend\DebtorController@create')->name('debtor-create');
Route::post('/aanmelding/debtor/store', 'Frontend\DebtorController@store')->name('debtor-store');

Route::get('/aanmelding/dossier', 'Frontend\DossierController@create')->name('dossier-create');
Route::post('/aanmelding/dossier/store', 'Frontend\DossierController@store')->name('dossier-store');