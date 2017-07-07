<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use App\Domain\Repositories\Contracts\CompanyRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class CompanyController extends Controller
{
    protected $dossierService;
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
       $this->companyRepository = $companyRepository;
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

    public function store(Request $request)
    {
        $companyData = $request->get('company');
        $id = $companyData['id'];

        if ($id) {
            $company = Company::findOrFail($id);
            if (!$this->authorize('update', $company)) {
                return redirect()->route('admin.home');
            }
        } else {
            $company = new Company();
            if (!$this->authorize('create', Company::class)) {
                return redirect()->route('admin.home');
            }
        }

        $this->companyRepository->store($company, $request);

        return \Redirect::route($this->routeIndex);
    }

}
