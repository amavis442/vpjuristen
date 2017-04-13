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

/*
 * Routes for maintenance and employees
 */
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', function(){
        return \Redirect::route('admin.login');
    });
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login')->middleware(['web', 'guest']);
    Route::post('/login', 'LoginController@login')->middleware(['web', 'guest']);
    Route::post('/logout', 'LoginController@logout')->name('admin.logout')->middleware(['web']);

    Route::get('/password/reset', 'LoginController@showLoginForm')->name('admin.password.request')->middleware(['web', 'guest']);

    Route::get('/home', 'HomeController@index')->name('admin.home');
    Route::get('/employee', 'EmployeeController@index')->name('admin.employee.index');


    Route::get('/employee/create', 'EmployeeController@create')->name('admin.employee.create');
    Route::get('/employee/edit/{id}', 'EmployeeController@edit')->name('admin.employee.edit');
    Route::post('/employee/store', 'EmployeeController@store')->name('admin.employee.store');

});


/**
 * Routes for frontend
 */
Route::group(['namespace' => 'Frontend', 'prefix' => 'registratie', 'middleware' => ['web', 'guest']], function () {
    // Controllers Within The "App\Http\Controllers\Frontend" Namespace
    Route::get('/', 'ClientController@create')->name('frontend.register.client.create');
    Route::post('store', 'ClientController@store')->name('frontend.register.client.store');
    Route::get('debtor', 'DebtorController@create')->name('frontend.register.debtor.create');
    Route::post('debtor/store', 'DebtorController@store')->name('frontend.register.debtor.store');
    Route::get('dossier', 'DossierController@create')->name('frontend.register.dossier.create');
    Route::post('dossier/store', 'DossierController@store')->name('frontend.register.dossier.store');
    Route::get('dossier/thankyou', 'DossierController@thankyou')->name('frontend.register.thankyou');

    Route::post('invoice/add', 'InvoiceController@ajaxAdd')->name('frontend.invoice.ajax.add');
    Route::post('invoice/del', 'InvoiceController@ajaxDelete')->name('frontend.invoice.ajax.delete');

});


/**
 * Routes for the dashboard
 */
Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard','middleware' => ['web'] ], function () {
    Route::get('/', function(){
        return \Redirect::route('dashboard.login');
    });

    Route::get('login', 'LoginController@login')->name('dashboard.login')->middleware(['web', 'guest']);
    Route::get('login/client', 'LoginClientController@showLoginForm')->name('dashboard.login.client')->middleware(['web', 'guest']);
    Route::get('login/debtor', 'LoginDebtorController@showLoginForm')->name('dashboard.login.debtor')->middleware(['web', 'guest']);
    Route::post('login/client', 'LoginClientController@login')->middleware(['web', 'guest']);
    Route::post('login/debtor', 'LoginDebtorController@login')->middleware(['web', 'guest']);
    Route::post('logout', 'LoginController@logout')->name('dashboard.logout')->middleware(['web']);


    Route::get('home', 'DashboardController@index')->name('dashboard');
    Route::get('dossier/index', 'DossierController@index')->name('dashboard.dossier.index');
    Route::get('dossier/create', 'DossierController@create')->name('dashboard.dossier.create');
    Route::get('dossier/edit', 'DossierController@edit')->name('dashboard.dossier.edit');
    Route::post('dossier/store', 'DossierController@store')->name('dashboard.dossier.store');

    Route::post('invoice/add', 'InvoiceController@ajaxAdd')->name('dashboard.invoice.ajax.add');
    Route::post('invoice/del', 'InvoiceController@ajaxDelete')->name('dashboard.invoice.ajax.delete');
    Route::get('invoice/downloadfile/{invoice_id}', 'InvoiceController@downloadFile')->name('dashboard.invoice.download.file');



    Route::get('user', 'UserController@index')->name('dashboard.user');
    Route::get('user/edit', 'UserController@edit')->name('dashboard.user.edit');
    Route::post('user/store', 'UserController@store')->name('dashboard.user.store');

});

