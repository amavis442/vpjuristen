<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Dossier;
use App\Repositories\Contracts\DossierRepositoryInterface;
use App\Repositories\Eloquent\ActionRepository;
use App\Repositories\Eloquent\InvoiceRepository;
use Illuminate\Support\Collection;

class DossierService
{
    /** @var  Dossier */
    protected $dossier;
    /** @var DossierRepositoryInterface  */
    protected $dossierRepository;


    public function __construct(DossierRepositoryInterface $dossierRepository)
    {
        $this->dossierRepository = $dossierRepository;
    }

    public function setDossier(Dossier $dossier)
    {
        $this->dossier = $dossier;
    }

    public function getClient(): Company
    {
        return $this->dossier->companies()->wherePivot('type', '=', 'client')->with('contacts')->get()->first();
    }


    public function getDebtor(): Company
    {
        return $this->dossier->companies()->wherePivot('type', '=', 'debtor')->with('contacts')->get()->first();
    }

    public function getInvoices(): Collection
    {
        return $this->dossier->invoices()->get();
    }

}