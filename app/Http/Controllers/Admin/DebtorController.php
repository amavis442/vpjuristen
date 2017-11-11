<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DebtorController extends Controller
{
    use CompanyTrait;


    public function __construct()
    {

    }

    public function index()
    {
        $companies = Company::with(['dossiers', 'users', 'contacts'])->debtor()->get();

        return view('admin.debtors.index', compact('companies'));
    }

    public function create(Request $request)
    {
        $data = $this->createCompany();

        return view('admin.debtors.create', $data);
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

        return \Redirect::route('admin.debtors.index');
    }

    public function show(Company $debtor)
    {
        $data = $this->showCompany($debtor);

        return view('admin.debtors.view', $data);
    }


    /**
     * @param         $id
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|View
     */
    public function edit(Request $request, Company $debtor)
    {
        $data = $this->editCompany($debtor);

        return view('admin.debtors.edit', $data);
    }

    /**
     * Save new company
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Company $debtor)
    {
        $this->updateCompany($request);

        return \Redirect::route('admin.debtors.index');
    }


}
