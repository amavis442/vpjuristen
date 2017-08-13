<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use Illuminate\Http\Request;

class ClientController extends AbstractCompanyController
{
    protected $name = 'client';
    protected $routeIndex = 'admin.clients.index';
    protected $routeEdit = 'admin.clients.edit';
    protected $routeStore = 'admin.clients.store';


    public function index()
    {
        if ($this->authorize('view',Company::class)) {
            return parent::getCompany('client');
        }
    }

    public function edit($id,Request $request)
    {
        return parent::editCompany($id, $request);
    }

    public function store(Request $request)
    {
        return parent::storeCompany($request);
    }
}
