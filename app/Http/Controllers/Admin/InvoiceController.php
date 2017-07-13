<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Repositories\Eloquent\DossierRepository;
use App\Services\DossierService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dossier;

class InvoiceController extends Controller
{
    protected $dossierService;

    public function __construct()
    {
        $this->dossierService = new DossierService(new DossierRepository());
    }

}
