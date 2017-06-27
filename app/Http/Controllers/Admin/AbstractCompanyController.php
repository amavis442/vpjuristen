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
use App\User;
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
    protected $name       = '';
    protected $routeIndex = 'admin.company.index';
    protected $routeEdit  = 'admin.company.edit';
    protected $routeStore = 'admin.company.store';

    public function getCompany($type = 'client')
    {
        /** @var \App\User $user */
        $user = Auth::user();

        if (!$user->can('view', Company::class)) {
            return redirect()->route('admin.home');
        }

        $repo = new EloquentCompanysRepository();
        $companies = $repo->getCompany($type);

        return view('admin.company.index',
                    ['type' => $type, 'route' => $this->routeEdit, 'companies' => $companies]);
    }

    public function createCompany(Request $request)
    {
        if (!Auth::guard('admin')->user()->can('create', Company::class)) {
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

        $company->fill($companyData);
        /** @var Company $company */
        $company->save();

        $userData = $request->get('user');
        $user_id = $userData['id'];
        if ($user_id) {
            $user = User::findOrFail($user_id);
        } else {
            $user = new User();
        }
        $user->fill($userData);
        $user->save();
        $company->users()->sync($user->id, false);


        $contactData = $request->get('contact');
        $contact_id = $contactData['id'];
        if ($contact_id) {
            $contact = Contact::findOrFail(($contact_id));
        } else {
            $contact = new Contact();
        }
        $contact->fill($contactData);
        $contact->save();

        $company->contacts()->sync($contact->id, false);
        $contact->users()->sync($user->id, false);

        return \Redirect::route($this->routeIndex);
    }

}