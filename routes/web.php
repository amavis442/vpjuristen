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
Route::group(['namespace' => 'Admin\Auth', 'prefix' => 'admin'], function () {
    Route::get('/', function () {
        return \Redirect::route('admin.login');
    });
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login')->middleware(['web', 'guest']);
    Route::post('/login', 'LoginController@login')->middleware(['web', 'guest']);
    Route::post('/logout', 'LoginController@logout')->name('admin.logout')->middleware(['web']);

    Route::get('/password/reset', 'LoginController@showLoginForm')->name('admin.password.request')->middleware([
        'web',
        'guest'
    ]);
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin','middleware' => ['auth:admin']], function () {

    Route::get('/home', 'HomeController@index')->name('admin.home');

    /* Employee */
    Route::get('/employee/create', 'EmployeeController@create')->name('admin.employee.create');
    Route::get('/employee/edit/{id}', 'EmployeeController@edit')->name('admin.employee.edit');
    Route::post('/employee/store', 'EmployeeController@store')->name('admin.employee.store');
    Route::get('/employee', 'EmployeeController@index')->name('admin.employee.index');

    /* Dossier */
    Route::get('/dossier/view/{id}', 'DossierController@show')->name('admin.dossier.show');
    Route::get('/dossier/edit/{id}', 'DossierController@edit')->name('admin.dossier.edit');
    Route::post('/dossier/store', 'DossierController@store')->name('admin.dossier.store');

    Route::get('/action/add/{id}', 'ActionController@create')->name('admin.dossier.action.create');
    Route::get('/action/edit/{id}', 'ActionController@edit')->name('admin.dossier.action.edit');
    Route::post('/action/store', 'ActionController@store')->name('admin.dossier.action.store');


    Route::get('/dossier/search', 'DossierController@search');

    Route::get('/dossier', 'DossierController@index')->name('admin.dossier.index');


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
Route::group(['namespace' => 'Dashboard\Auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', function () {
        return \Redirect::route('dashboard.login');
    });

    Route::get('login', 'LoginController@showLoginForm')->name('dashboard.login')->middleware(['web', 'guest']);
    Route::get('login/client', 'LoginController@showLoginFormClient')->name('dashboard.login.client')->middleware(['web', 'guest']);
    Route::get('login/debtor', 'LoginController@showLoginFormDebtor')->name('dashboard.login.debtor')->middleware(['web', 'guest']);

    Route::post('login', 'LoginController@login')->middleware(['web', 'guest']);

    Route::post('logout', 'LoginController@logout')->name('dashboard.logout')->middleware(['web']);


});

Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard'], function () {
    Route::get('home', 'DashboardController@index')->name('dashboard.home');
    Route::get('dossier/index', 'DossierController@index')->name('dashboard.dossier.index');
    Route::get('dossier/create', 'DossierController@create')->name('dashboard.dossier.create');
    Route::get('dossier/edit', 'DossierController@edit')->name('dashboard.dossier.edit');
    Route::post('dossier/store', 'DossierController@store')->name('dashboard.dossier.store');

    Route::post('invoice/add', 'InvoiceController@ajaxAdd')->name('dashboard.invoice.ajax.add');
    Route::post('invoice/del', 'InvoiceController@ajaxDelete')->name('dashboard.invoice.ajax.delete');
    Route::get('invoice/downloadfile/{invoice_id}',
        'InvoiceController@downloadFile')->name('dashboard.invoice.download.file');

    Route::get('user', 'UserController@index')->name('dashboard.user');
    Route::get('user/edit', 'UserController@edit')->name('dashboard.user.edit');
    Route::post('user/store', 'UserController@store')->name('dashboard.user.store');
});
