<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Doctrine\Common\Collections\ArrayCollection;
use App\Dossier;
use App\Invoice;
use App\File as InvoiceFile;
use App\Domain\Repository\EloquentDossiersRepository;
use App\Domain\Services\Dossier\DossierService;

class CompanyController extends Controller
{
    protected $dossierService;

    public function __construct()
    {
        $this->dossierService = new DossierService();
    }

    public function edit(Company $company, Request $request)
    {
        /** @var \App\Company $company */
        if (!$this->authorize('edit', $company)) {
            return redirect()->route('dashboard.home');
        }

        $contact = $company->contacts()->first();
        $user = $company->users()->get()->first();
        if (is_null($user)) {
            $user = new User();
        }

        return view('dashboard.company.edit',
                    [
                        'route' => 'dashboard.client.store',
                        'company' => $company,
                        'contact' => $contact,
                        'user' => $user,
                        'contactShort' => false
                    ]);
    }


}
