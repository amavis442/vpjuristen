<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/16/17
 * Time: 11:04 PM
 */

namespace App\Http\Controllers\Admin;


use App\Domain\Repository\EloquentCompanysRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\Role;
use App\Contact;
use App\Company;
use Illuminate\View\View;


abstract class AbstractCompanyController extends Controller
{
    protected $name = '';
    protected $routeIndex = 'admin.company.index';
    protected $routeEdit = 'admin.company.edit';
    protected $routeStore = 'admin.company.store';

    public function getCompany($type = 'client')
    {
        /** @var \App\User $user */
        $user = Auth::guard('admin')->user();
        if (!$user->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        $repo = new EloquentCompanysRepository();
        $companies = $repo->getCompany($type);

        return view('admin.company.index', ['routeEdit' => $this->routeEdit, 'companies' => $companies]);
    }

    public function createCompany(Request $request)
    {
        if (!Auth::guard('admin')->user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        $user = new Admin();
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
        if (!Auth::guard('admin')->user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        /** @var \App\Company $company */
        $company = Company::find($id);
        $contact = $company->contacts()->first();

        return view('admin.company.edit',
            ['routeName' => $this->routeStore, 'company' => $company, 'contact' => $contact, 'contactShort' => false]);
    }

    public function storeCompany(Request $request)
    {
        if (!Auth::guard('admin')->user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        $companyData = $request->get('company');
        $id = $companyData['id'];
        unset($companyData['id']);
        /** @var Company $company */
        $company = Company::updateOrCreate(['id'=>$id], $companyData);

        $contactData = $request->get('contact');
        $id = $contactData['id'];
        unset($contactData['id']);
        $contact = Contact::updateOrCreate(['id'=>$id], $contactData);

        return \Redirect::route($this->routeIndex);
    }

}