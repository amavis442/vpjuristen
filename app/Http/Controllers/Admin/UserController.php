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

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var \App\Models\Role $roles */
        //$roles = Role::with('users')->where('name', 'admin')->get();
        $users = User::whereNotIn('role',['admin','manager','employee'])->get()->all();

        return view('employees.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('employees.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!Auth::guard()->user()->can('manage-employees')) {
            return redirect()->route('admin.home');
        }

        /** @var User $user */

        $contact = $user->contacts()->first();
        $company = Company::find(1);

        $roles = (new Role())->getAdminRoles();

        return view('employees.edit ', [
            'user'         => $user,
            'company'      => $company,
            'contact'      => $contact,
            'contactShort' => false,
            'roles'        => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, User::RULES);

        $user->name  = $request->input('user.name');
        $user->email = $request->input('user.email');
        if ($request->has('user.password') && !empty($request->input('user.password'))) {
            $user->password = \Hash::make($request->input('user.password'));
        }
        $user->save();

        $roles = $request->get('roles');
        $user->roles()->sync($roles);

        return redirect()->route('admin.employees.index')->with('msg', 'Employee updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.employees.index')->with('msg', 'Employee deleted');//
    }
}
