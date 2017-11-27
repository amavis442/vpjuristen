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
})->name('start');


Auth::routes();
Route::impersonate();

Route::get('/home', 'HomeController@index');

/**
 * Routes for frontend
 */
Route::group([
                 'namespace'  => 'Frontend',
                 'as'         => 'frontend.',
                 'prefix'     => 'registratie',
                 'middleware' => ['web', 'guest'],
             ], function () {

    Route::resource('client', 'ClientController', ['only' => ['create', 'store']]);
    Route::resource('debtor', 'DebtorController', ['only' => ['create', 'store']]);
    Route::resource('dossier', 'DossierController', ['only' => ['create', 'store', 'show']]);
    Route::get('dossier/thankyou', 'DossierController@thankyou')->name('dossier.thankyou');

    Route::post('invoice/create', 'InvoiceController@ajaxAdd')->name('invoice.ajax.add');
    Route::post('invoice/destroy', 'InvoiceController@ajaxDelete')->name('invoice.ajax.delete');
});

/**
 * Routes for Admin: maintenance, pages, employees and dossiers
 */
Route::group(['namespace' => 'Admin','prefix' => 'admin','as' => 'admin.'], function () {

    // Auth Login / logout
    Route::group(['namespace' => 'Auth'], function () {

        Route::get('/', function () {
            return \Redirect::route('login');
        });

        Route::group(['middleware' => ['web', 'guest']], function () {
            Route::get('/login', 'LoginController@showLoginForm')->name('login');
            Route::post('/login', 'LoginController@login');

            Route::get('/password/reset', 'LoginController@showLoginForm')->name('password.request');
        });

        Route::post('/logout', 'LoginController@logout')->name('logout')->middleware(['web']);
    });

    // Admin
    Route::group(['middleware' => ['auth', 'role:admin,manager,employee']], function () {
        Route::get('/file/download/{invoice}/{id}', 'InvoiceController@download')->name('file.download');

        Route::get('/home', 'HomeController@index')->name('home');

        /* Pages: create, edit and update pages */

        /* Employee admin: create, update and add/update roles to employee users */
        Route::resource('employees', 'EmployeeController');
        Route::resource('users', 'UserController');

        Route::resource('companies', 'CompanyController@index');

        /* Dossier admin: update dossier, add action and comments */
        Route::resource('dossiers', 'DossierController');
        Route::get('/dossiers/search', 'DossierController@search')->name('dossiers.search');

        Route::resource('invoices', 'InvoiceController');

        /* Client admin: see client data and update them */
        Route::resource('clients', 'ClientController');
        Route::get('/client/search', 'ClientController@search');

        /* Debtor admin: see debtor data and update them */
        Route::resource('debtors', 'DebtorController');
        Route::get('/debtor/search', 'DebtorController@search');


        /* Action admin: add an action to a dossier. An action can be receiving a payment, contact with debtor/client etc. */
        Route::resource('actions', 'ActionController');

        /* Comment admin: add an comment to a dossier/action. */
        Route::resource('comments', 'CommentController');

        /* Collection admin: payment received from debtor */
        //Route::get('/collect/add/{id}', 'CollectController@create')->name('admin.action.collect.create');
        //Route::get('/collect/edit/{id}', 'CollectController@edit')->name('admin.action.collect.edit');
        //Route::post('/collect/store', 'CollectController@store')->name('admin.action.collect.store');


        /* Payment admin: payment done to client */
        //Route::get('/payment/add/{id}', 'PaymentController@create')->name('admin.action.payment.create');
        //Route::get('/payment/edit/{id}', 'PaymentController@edit')->name('admin.action.payment.edit');
        //Route::post('/payment/store', 'PaymentController@store')->name('admin.action.payment.store');

    });

});

/**
 * Routes for the dashboard: dossier, nawt
 */
Route::group(['prefix' => 'dashboard'], function () {

    // Auth Login / Logout
    Route::group(['namespace' => 'Dashboard\Auth', 'middleware' => ['web']], function () {
        Route::get('/', function () {
            return \Redirect::route('dashboard.login');
        });
        Route::group(['middleware' => ['guest']], function () {
            // Login and logout client and debtor
            Route::get('login', 'LoginController@showLoginForm')->name('dashboard.login');
            Route::get('login/client',
                       'LoginController@showLoginFormClient')->name('dashboard.login.client');
            Route::get('login/debtor',
                       'LoginController@showLoginFormDebtor')->name('dashboard.login.debtor');

            Route::post('login', 'LoginController@login');
        });
        Route::post('logout', 'LoginController@logout')->name('dashboard.logout');
    });

    Route::group(['namespace' => 'Dashboard', 'middleware' => ['auth', 'role:client']],
        function () {
            Route::get('home', 'DashboardController@index')->name('dashboard.home');

            // Dossier: See dossier with actions, approved comments and payments
            Route::get('dossier/index', 'DossierController@index')->name('dashboard.dossier.index');
            Route::get('dossier/create', 'DossierController@create')->name('dashboard.dossier.create');
            Route::get('dossier/edit/{id}', 'DossierController@edit')->name('dashboard.dossier.edit');
            Route::post('dossier/store', 'DossierController@store')->name('dashboard.dossier.store');
            Route::get('dossier/view/{id}', 'DossierController@view')->name('dashboard.dossier.show');
            //Route::get('dossier/search', 'DossierController@search');


            // Invoice:
            //Route::post('invoice/add', 'InvoiceController@ajaxAdd')->name('dashboard.invoice.ajax.add');
            //Route::post('invoice/del', 'InvoiceController@ajaxDelete')->name('dashboard.invoice.ajax.delete');
            //Route::get('invoice/downloadfile/{invoice_id}',
            //           'InvoiceController@downloadFile')->name('dashboard.invoice.download.file');

            Route::get('/client/edit/{company}', 'CompanyController@edit')->name('dashboard.client.edit');
            Route::post('/client/store', 'CompanyController@store')->name('dashboard.client.store');


            Route::get('/file/download/{file}', 'FileController@download')->name('dashboard.file.download');


            Route::get('/debtor/view/{id}', 'UserController@show')->name('dashboard.debtor.show');


            // User admin to edit their data and login credentials
            Route::get('user', 'UserController@index')->name('dashboard.user');
            Route::get('user/edit', 'UserController@edit')->name('dashboard.user.edit');
            Route::post('user/store', 'UserController@store')->name('dashboard.user.store');
        });
});