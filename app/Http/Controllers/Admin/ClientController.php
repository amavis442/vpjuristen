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

class ClientController extends Controller
{
    protected $name = '';

    /** @var  CompanyRepositoryInterface */
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index()
    {
        $companies = Company::with(['dossiers', 'users', 'contacts'])->client()->get();

        return view('company.admin.index',
                    ['type' => 'client', 'route' => 'admin.client.show', 'companies' => $companies]);
    }

    public function create(Request $request)
    {
        if (!$this->authorize('create', Company::class)) {
            return redirect()->route('admin.home');
        }

        $user = new User();
        $contact = new Contact();

        return view('admin.company.create', ['route' => 'admin.client.store', 'user' => $user, 'contact' => $contact, 'contactShort' => false]);
    }

    /**
     * Save new company
     *
     * @param Request $request
     *
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

    public function show(Company $client)
    {
        $contact = $client->contacts()->first();
        $user = $contact->users()->first();

        return view('company.admin.show',
                    [
                        'type'    => 'client',
                        'route'   => 'admin.client.edit',
                        'company' => $client,
                        'contact' => $client,
                        'user'    => $user,
                    ]);
    }


    /**
     * @param         $id
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|View
     */
    public function edit(Request $request, Company $client)
    {
        /** @var \App\Models\Company $company */
        if (!$this->authorize('edit', $client)) {
            return redirect()->route('admin.home');
        }

        $contact = $client->contacts()->first();
        $user = $client->users()->get()->first();
        if (is_null($user)) {
            $user = new User();
        }

        return view('company.admin.edit',
                    [
                        'route'        => 'admin.client.update',
                        'company'      => $client,
                        'contact'      => $contact,
                        'user'         => $user,
                        'contactShort' => false,
                    ]);
    }

    /**
     * Save new company
     *
     * @param Request $request
     *
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

        return \Redirect::route('admin.client.index');
    }


}