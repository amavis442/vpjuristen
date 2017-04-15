<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Role;
use App\Contact;
use App\Company;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    public function index()
    {
        /** @var Roles $roles */
        //$roles = Role::with('users')->where('name', 'admin')->get();
        $users = Admin::whereHas('roles', function ($q) {
            $q->whereIn('name', ['admin','employee']);
        })->get()->all();

        return view('admin.employee.index', ['users' => $users]);
    }

    public function create(Request $request)
    {
        $user = new Admin();
        $contact = new Contact();
        return view('admin.employee.create', ['user' => $user, 'contact' => $contact, 'contactShort' => false]);
    }

    public function edit($id, Request $request)
    {
        /** @var Admin $user */
        $user = Admin::find($id);
        $contact = $user->contacts()->first();

        return view('admin.employee.edit', ['user' => $user, 'contact' => $contact, 'contactShort' => false]);
    }

    public function store(Request $request)
    {
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

        /** @var Admin $user */
        /** @var Company $company */
        $user = Admin::updateOrCreate(['id'=>$user_id],$dataUser);
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
