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
    use CompanyTrait;

    public function __construct()
    {

    }

    public function index()
    {
        $companies = Company::with(['dossiers', 'users', 'contacts'])->client()->get();

        return view('admin.clients.index', compact('companies'));
    }

    public function create(Request $request)
    {
        $data = $this->createCompany();

        return view('admin.clients.create', $data);
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
        $this->storeCompany($request);

        return \Redirect::route('admin.clients.index');
    }

    public function show(Company $client)
    {
        $data = $this->showCompany($client);

        return view('admin.clients.view', $data);
    }


    /**
     * @param         $id
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|View
     */
    public function edit(Request $request, Company $client)
    {
        $data = $this->editCompany($client);

        return view('admin.clients.edit', $data);

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
        $this->updateCompany($request);

        return \Redirect::route('admin.clients.index');
    }


}