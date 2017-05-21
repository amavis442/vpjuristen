<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends AbstractCompanyController
{
    protected $name = 'client';
    protected $routeIndex = 'admin.client.index';
    protected $routeEdit = 'admin.client.edit';
    protected $routeStore = 'admin.client.store';

    public function index()
    {
        return parent::getCompany('client');
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
