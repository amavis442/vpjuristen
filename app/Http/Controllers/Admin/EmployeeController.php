<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Contact;
use App\Company;
use Illuminate\View\View;

class EmployeeController extends Controller
{

    public function index()
    {
        if (!Auth::user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        /** @var \App\Role $roles */
        //$roles = Role::with('users')->where('name', 'admin')->get();
        $users = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['admin','employee']);
        })->get()->all();

        return view('admin.employee.index', ['users' => $users]);
    }

    public function create(Request $request)
    {
        if (!Auth::user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        $company = Company::find(1);

        $user = new User();
        $contact = new Contact();
        return view('admin.employee.create', ['user' => $user, 'company'=>$company,'contact' => $contact, 'contactShort' => false]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|View
     */
    public function edit($id, Request $request)
    {
        if (!Auth::guard('admin')->user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        /** @var User $user */
        $user = User::find($id);
        $contact = $user->contacts()->first();
        $company = Company::find(1);
        return view('admin.employee.edit', ['user' => $user,'company'=>$company, 'contact' => $contact, 'contactShort' => false]);
    }

    public function store(Request $request)
    {
        if (!Auth::guard('admin')->user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        $isNew = true;
        $dataUser = $request->get('user');
        if (isset($dataUser['password'])) {
            $dataUser['password'] = bcrypt($dataUser['password']);
        }
        $dataUser['active'] = 1;

        $user_id = 0;
        if (isset($dataUser['id']) && $dataUser['id'] > 0) {
            if (empty($dataUser['password'])) {
                unset($dataUser['password']); // Keep the old password
            }
            $isNew = false;
            $user_id = $dataUser['id'];
        }

        /** @var User $user */
        /** @var Company $company */
        $user = User::updateOrCreate(['id'=>$user_id],$dataUser);
        $company = Company::where(['name' => 'admin-prime', 'company' => 'admin-prime'])->get()->first();

        $dataRole = $request->get('role');
        $roleNames = ['admin', 'employee'];

        foreach ($roleNames as $roleName) {
            $role = Role::where(['name' => $roleName])->get()->first();
            $hasRole = $user->hasRole($roleName);
            if (!is_null($role)) {

                if (isset($dataRole[$roleName]) && !$hasRole) {
                    $user->roles()->withTimestamps()->attach($role->id);
                } else {
                    if (!$hasRole) {
                        $user->roles()->detach($role->id);
                    }
                }
            }
        }
        if ($isNew) {
            $user->companies()->withTimestamps()->attach($company->id);
        }

        $dataContact = $request->get('contact');
        $contact_id = $dataContact['id'];
        unset($dataContact['id']);
        $contact = $company->contacts()->updateOrCreate(['id' => $contact_id], $dataContact);

        if ($isNew) {
            $user->contacts()->withTimestamps()->attach($contact->id);
        }
        return \Redirect::route('admin.employee.index');
    }
}
