<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Company;
use App\Contact;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /** @var User $user */
        $user = User::create([
                                 'name' => 'patrick',
                                 'email' => 'patrick@test.nl',
                                 'password' => \Hash::make('secret'),
                                 'active' => 1
                             ]);

        $role = Role::where(['name' => 'admin'])->get()->first();
        if (is_null($role)) {
            $user->delete();
            throw new \Exception('Please run the RoleSeeder first');
        }
        $user->roles()->save($role);

        $company = new Company();
        $company->name = 'admin-prime';
        $company->company = 'admin-prime';
        $company->street = 'admin';
        $company->housenr = 1;
        $company->postcode = '1234AA';
        $company->city = 'Ede';
        $company->country = 'NL';
        $company->phone = '06123456789';
        $company->email = 'patrick@test.nl';
        $company->website = '';
        $user->companies()->save($company);

        $contact = new Contact();
        $contact->name = 'admin';
        $contact->firstname = 'admin';
        $contact->middlename = '';
        $contact->sexe = 'M';
        $contact->title = 'admin';
        $contact->street = 'admin';
        $contact->housenr = 1;
        $contact->city = 'Ede';
        $contact->zipcode = '1234AA';
        $contact->country = 'NL';
        $contact->phone = '06123456789';
        $contact->email = 'patrick@test.nl';
        $contact->fax = '';
        $contact->remarks = 'Admin';
        $user->contacts()->save($contact);

        $company->contacts()->withTimestamps()->attach($contact->id);

    }
}
