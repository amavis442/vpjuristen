<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Contact;
use App\Models\Company;
use Illuminate\View\View;

class EmployeeController extends Controller
{

    public function index()
    {
        if (!Auth::user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        /** @var \App\Models\Role $roles */
        //$roles = Role::with('users')->where('name', 'admin')->get();
        $users = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['admin', 'employee']);
        })->get()->all();

        return view('admin.employee.index', ['users' => $users]);
    }

    public function create(Request $request)
    {
        if (!Auth::user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        $company = Company::find(1);

        $user    = new User();
        $contact = new Contact();
        return view('admin.employee.create', ['user' => $user, 'company' => $company, 'contact' => $contact, 'contactShort' => false]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|View
     */
    public function edit($id, Request $request)
    {
        if (!Auth::guard()->user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        /** @var User $user */
        $user    = User::find($id);
        $contact = $user->contacts()->first();
        $company = Company::find(1);
        return view('admin.employee.edit', ['user' => $user, 'company' => $company, 'contact' => $contact, 'contactShort' => false]);
    }

    public function store(Request $request)
    {
        if (!Auth::guard()->user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        $isNew    = true;
        $dataUser = $request->get('user');
        if (isset($dataUser['password'])) {
            $dataUser['password'] = \Hash::make($dataUser['password']);
        }
        $dataUser['active'] = 1;

        $user_id = 0;
        if (isset($dataUser['id']) && $dataUser['id'] > 0) {
            if (empty($dataUser['password'])) {
                unset($dataUser['password']); // Keep the old password
            }
            $isNew   = false;
            $user_id = $dataUser['id'];
        }

        /** @var User $user */
        /** @var Company $company */
        $user = User::updateOrCreate(['id' => $user_id], $dataUser);

        $company = Company::where(['name' => 'admin-prime', 'company' => 'admin-prime'])->get()->first();
        if ($isNew) {
            $company->users()->associate($user);
        }

        $dataRole  = $request->get('role');
        $roleNames = ['admin', 'employee'];
        foreach ($roleNames as $roleName) {
            $role    = Role::where(['name' => $roleName])->get()->first();
            $hasRole = $user->hasRole($roleName);
            if (!is_null($role)) {

                if (isset($dataRole[$roleName]) && !$hasRole) {
                    $user->roles()->attach($role->id);
                } else {
                    if (!isset($dataRole[$roleName]) && $hasRole) {
                        $user->roles()->detach($role->id);
                    }
                }
            }
        }


        $dataContact = $request->get('contact');
        $contact_id  = $dataContact['id'];
        unset($dataContact['id']);

        $contact = Contact::firstOrCreate(['id' => $contact_id]);
        $contact->fill($dataContact);
        $contact->save();
        $company->contacts()->sync($contact->id, false);
        $user->contacts()->sync($contact->id, false);


        return \Redirect::route('admin.employee.index');
    }
}
