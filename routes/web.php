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
Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/file/download/{invoice}/{id}', 'InvoiceController@download')->name('file.download');

    Route::resource('invoice', 'InvoiceController');
});

/*
 * Routes for maintenance, pages, employees and dossiers
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


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {

    Route::get('/home', 'HomeController@index')->name('admin.home');

    /* Pages: create, edit and update pages */

    /* Employee admin: create, update and add/update roles to employee users */
    Route::resource('employees', 'EmployeeController', ['as' => 'admin']);
    Route::resource('users', 'UserController', ['as' => 'admin']);

    /* Dossier admin: update dossier, add action and comments */
    Route::resource('dossiers', 'DossierController', ['as' => 'admin']);
    Route::get('/dossiers/search', 'DossierController@search');


    Route::resource('client', 'ClientController', ['as' => 'admin']);

    //Route::resource('companies','CompanyController',['as' => 'admin']);
    Route::get('/companies/{type}', 'CompanyController@index')->name('admin.companies.index');
    Route::get('/companies/{company}/edit', 'CompanyController@edit')->name('admin.companies.edit');

    //Route::get('/dossier/list/{id}', 'DossierController@list')->name('admin.dossier.list');
    //Route::get('/dossier/view/{id}', 'DossierController@show')->name('admin.dossier.show');
    //Route::get('/dossier/edit/{id}', 'DossierController@edit')->name('admin.dossier.edit');
    //Route::post('/dossier/store', 'DossierController@store')->name('admin.dossier.store');
    //Route::get('/dossier', 'DossierController@index')->name('admin.dossier.index');




    /* Client admin: see client data and update them */
    Route::get('/client/search', 'ClientController@search');
    //Route::resource('clients',ClientController::class,['as' => 'admin']);

    //Route::get('/client/view/{id}', 'ClientController@show')->name('admin.client.show');
    //Route::get('/client/edit/{id}', 'ClientController@edit')->name('admin.client.edit');
    //Route::post('/client/store', 'ClientController@store')->name('admin.client.store');
    //Route::get('/client', 'ClientController@index')->name('admin.client.index');

    /* Debtor admin: see debtor data and update them */
    Route::get('/debtor/search', 'DebtorController@search');
    Route::get('/debtor/view/{id}', 'DebtorController@show')->name('admin.debtor.show');
    Route::get('/debtor/edit/{id}', 'DebtorController@edit')->name('admin.debtor.edit');
    Route::post('/debtor/store', 'DebtorController@store')->name('admin.debtor.store');
    Route::get('/debtor', 'DebtorController@index')->name('admin.debtor.index');


    /* Action admin: add an action to a dossier. An action can be receiving a payment, contact with debtor/client etc. */
    Route::get('/action/add/{id}', 'ActionController@create')->name('admin.dossier.action.create');
    Route::get('/action/edit/{id}', 'ActionController@edit')->name('admin.dossier.action.edit');
    Route::post('/action/store', 'ActionController@store')->name('admin.dossier.action.store');

    /* Comment admin: add an comment to a dossier/action. */
    Route::get('/comment/add/{id}', 'CommentController@create')->name('admin.comment.create');
    Route::get('/comment/edit/{comment}', 'CommentController@edit')->name('admin.comment.edit');
    Route::post('/comment/store', 'CommentController@store')->name('admin.comment.store');

    /* Collection admin: payment received from debtor */
    //Route::get('/collect/add/{id}', 'CollectController@create')->name('admin.action.collect.create');
    //Route::get('/collect/edit/{id}', 'CollectController@edit')->name('admin.action.collect.edit');
    //Route::post('/collect/store', 'CollectController@store')->name('admin.action.collect.store');


    /* Payment admin: payment done to client */
    //Route::get('/payment/add/{id}', 'PaymentController@create')->name('admin.action.payment.create');
    //Route::get('/payment/edit/{id}', 'PaymentController@edit')->name('admin.action.payment.edit');
    //Route::post('/payment/store', 'PaymentController@store')->name('admin.action.payment.store');

});


/**
 * Routes for frontend
 */
/*
Route::group(['namespace' => 'Frontend', 'prefix' => 'registratie', 'middleware' => ['web', 'guest']], function () {
    // Controllers Within The "App\Http\Controllers\Frontend" Namespace
    Route::get('/', 'ClientController@create')->name('frontend.register.client.create');
    Route::post('store', 'ClientController@store')->name('frontend.register.client.store');
    Route::get('debtor', 'DebtorController@create')->name('frontend.register.debtor.create');
    Route::post('debtor/store', 'DebtorController@store')->name('frontend.register.debtor.store');
    Route::get('dossier', 'DossierController@create')->name('frontend.register.dossier.create');
    Route::post('dossier/store', 'DossierController@store')->name('frontend.register.dossier.store');
    Route::get('dossier/thankyou', 'DossierController@thankyou')->name('frontend.register.thankyou');

    //Route::post('invoice/add', 'InvoiceController@ajaxAdd')->name('frontend.invoice.ajax.add');
    //Route::post('invoice/del', 'InvoiceController@ajaxDelete')->name('frontend.invoice.ajax.delete');

});
*/

/**
 * Routes for the dashboard
 */
/*
Route::group(['namespace' => 'Dashboard\Auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', function () {
        return \Redirect::route('dashboard.login');
    });

    // Login and logout client and debtor
    Route::get('login', 'LoginController@showLoginForm')->name('dashboard.login')->middleware(['web', 'guest']);
    Route::get('login/client',
               'LoginController@showLoginFormClient')->name('dashboard.login.client')->middleware(['web', 'guest']);
    Route::get('login/debtor',
               'LoginController@showLoginFormDebtor')->name('dashboard.login.debtor')->middleware(['web', 'guest']);

    Route::post('login', 'LoginController@login')->middleware(['web', 'guest']);

    Route::post('logout', 'LoginController@logout')->name('dashboard.logout')->middleware(['web']);


});

Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'middleware' => ['auth', 'role:client']],
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
        Route::post('invoice/add', 'InvoiceController@ajaxAdd')->name('dashboard.invoice.ajax.add');
        Route::post('invoice/del', 'InvoiceController@ajaxDelete')->name('dashboard.invoice.ajax.delete');
        Route::get('invoice/downloadfile/{invoice_id}',
                   'InvoiceController@downloadFile')->name('dashboard.invoice.download.file');

        Route::get('/client/edit/{company}', 'CompanyController@edit')->name('dashboard.client.edit');
        Route::post('/client/store', 'CompanyController@store')->name('dashboard.client.store');


        Route::get('/file/download/{file}', 'FileController@download')->name('dashboard.file.download');


        Route::get('/debtor/view/{id}', 'UserController@show')->name('dashboard.debtor.show');


        // User admin to edit their data and login credentials
        Route::get('user', 'UserController@index')->name('dashboard.user');
        Route::get('user/edit', 'UserController@edit')->name('dashboard.user.edit');
        Route::post('user/store', 'UserController@store')->name('dashboard.user.store');
    });
*/