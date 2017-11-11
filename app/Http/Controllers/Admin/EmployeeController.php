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
    /**
     * Show list of employees
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function index()
    {
        /** @var \App\Models\Role $roles */
        //$roles = Role::with('users')->where('name', 'admin')->get();
        $users = User::whereIn('role', ['employee', 'manager', 'admin'])->get()->all();

        return view('admin.employees.index', ['users' => $users]);
    }

    /**
     * Create a new employee
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|View
     */
    public function create()
    {
        if (!Auth::user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        $company = Company::find(1);

        $user    = new User();
        $contact = new Contact();
        $roles   = (new Role())->getAdminRoles();

        return view('employees.create', [
            'user'         => $user,
            'company'      => $company,
            'contact'      => $contact,
            'contactShort' => false,
            'roles'        => $roles,
        ]);
    }

    /**
     * Store a new employee
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        $this->validate($request, User::RULES);

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
            $user_id = $dataUser['id'];
        }

        // User
        /** @var User $user */
        /** @var Company $company */
        $user = User::updateOrCreate(['id' => $user_id], $dataUser);

        // Company
        $company = Company::find(1);
        $company->users()->attach($user->id);

        $roles = $request->get('roles');
        $user->roles()->sync($roles);

        // Contact
        $dataContact = $request->get('contact');
        $contact_id  = $dataContact['id'];
        unset($dataContact['id']);

        $contact = Contact::firstOrNew(['id' => $contact_id]);
        $contact->fill($dataContact);
        $contact->save();

        $contact->companies()->sync([$company->id]);
        $contact->users()->sync([$user->id]);

        return redirect()->route('admin.employees.index');
    }

    public function show(Request $request, User $user)
    {
        return view('employees.index');
    }

    /**
     * Edit an existing employee
     *
     * @param         $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|View
     */
    public function edit(User $employee, Request $request)
    {
        if (!Auth::guard()->user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        /** @var User $user */

        $contact = $employee->contacts()->first();
        $company = Company::find(1);
        $roles   = User::ROLES;

        return view('admin.employees.edit ', [
            'user'         => $employee,
            'company'      => $company,
            'contact'      => $contact,
            'contactShort' => false,
            'roles'        => $roles,
        ]);
    }


    /**
     * Update an existing user
     *
     * @param Request $request
     * @param User    $user
     *
     */
    public function update(User $employee, Request $request)
    {
        $this->validate($request, User::RULES);

        $employee->name  = $request->input('user.name');
        $employee->email = $request->input('user.email');
        if ($request->has('user.password') && !empty($request->input('user.password'))) {
            $employee->password = \Hash::make($request->input('user.password'));
        }
        $employee->save();

        $roles = $request->get('roles');
        $employee->roles()->sync($roles);

        return redirect()->route('admin.employees.index')->with('msg', 'Employee updated.');
    }

    public function destroy(User $employee, Request $request)
    {
        $employee->delete();

        return redirect()->route('admin.employees.index')->with('msg', 'Employee deleted');
    }
}
