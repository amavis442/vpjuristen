<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/16/17
 * Time: 11:04 PM
 */

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\Company;
use Illuminate\View\View;

class CompanyController extends Controller
{
    protected $name       = '';
    protected $routeIndex = 'admin.companies.index';
    protected $routeEdit  = 'admin.companies.edit';
    protected $routeStore = 'admin.companies.store';
    /** @var  CompanyRepositoryInterface */
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index(Request $request, $type)
    {
        $companies = $this->companyRepository->getCompany($type);

        return view('company.admin.index',
                    ['type' => $type, 'route' => $this->routeEdit, 'companies' => $companies]);
    }

    public function create(Request $request)
    {
        if (!$this->authorize('create', Company::class)) {
            return redirect()->route('admin.home');
        }

        $user = new User();
        $contact = new Contact();
        return view('admin.company.create', ['user' => $user, 'contact' => $contact, 'contactShort' => false]);
    }

    /**
     * Save new company
     *
     * @param Request $request
     * @return RedirectResponse
     */
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

    public function show($type = 'client')
    {
        $companies = $this->companyRepository->getCompany($type);

        return view('admin.company.index',
                    ['type' => $type, 'route' => $this->routeEdit, 'companies' => $companies]);
    }


    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|View
     */
    public function edit(Request $request, Company $company)
    {
        /** @var \App\Models\Company $company */
        if (!$this->authorize('edit', $company)) {
            return redirect()->route('admin.home');
        }
        $contact = $company->contacts()->first();
        $user = $company->users()->get()->first();
        if (is_null($user)) {
            $user = new User();
        }

        return view('admin.company.edit',
                    [
                        'route' => $this->routeStore,
                        'company' => $company,
                        'contact' => $contact,
                        'user' => $user,
                        'contactShort' => false
                    ]);
    }
    /**
     * Save new company
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request, Company $company)
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