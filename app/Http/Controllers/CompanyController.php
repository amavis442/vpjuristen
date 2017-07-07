<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/16/17
 * Time: 11:04 PM
 */

namespace App\Http\Controllers\Admin;


use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\CompanyRepository;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\Company;
use Illuminate\View\View;


class CompanyController extends Controller
{
    protected $name       = '';
    protected $routeIndex = 'admin.company.index';
    protected $routeEdit  = 'admin.company.edit';
    protected $routeStore = 'admin.company.store';
    /** @var  CompanyRepositoryInterface */
    protected $companyRepository;
    protected $user;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;

        /** @var \App\User $user */
        $this->user = Auth::user();
    }

    public function getCompany($type = 'client')
    {
        if (!$this->user->can('view', Company::class)) {
            return redirect()->route('admin.home');
        }

        $companies = $this->companyRepository->getCompany($type);

        return view('admin.company.index',
                    ['type' => $type, 'route' => $this->routeEdit, 'companies' => $companies]);
    }

    public function createCompany(Request $request)
    {
        if (!$this->user->can('create', Company::class)) {
            return redirect()->route('admin.home');
        }

        $user = new User();
        $contact = new Contact();
        return view('admin.company.create', ['user' => $user, 'contact' => $contact, 'contactShort' => false]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|View
     */
    public function editCompany($id, Request $request)
    {
        /** @var \App\Company $company */
        $company = Company::findOrFail($id);
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

    public function storeCompany(Request $request)
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