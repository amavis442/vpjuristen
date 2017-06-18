<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Domain\Repository\EloquentDossiersRepository;
use App\Domain\Services\Dossier\DossierService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dossier;

class InvoiceController extends Controller
{
    protected $dossierService;

    public function __construct()
    {
        $this->dossierService = new DossierService();
    }

}
