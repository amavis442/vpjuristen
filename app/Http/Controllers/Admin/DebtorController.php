<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DebtorController extends Controller
{
    protected $name = 'debtor';
    protected $routeIndex = 'admin.debtor.index';
    protected $routeEdit = 'admin.debtor.edit';
    protected $routeStore = 'admin.debtor.store';

    public function index()
    {
        return parent::getCompany($this->name);
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
