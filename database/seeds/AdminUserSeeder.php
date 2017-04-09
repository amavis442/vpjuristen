<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Company;

class AdminUserSeeder extends Seeder
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
            'password' => bcrypt('secret'),
            'active' => 1
        ]);

        $role = Role::where(['name' => 'admin'])->get()->first();
        if (is_null($role)) {

            $user->delete();

            throw new \Exception('Please run the RoleSeeder first');
        } else {
            $role_id = $role->id;
        }

        $user->roles()->withTimestamps()->attach($role_id);

        /** @var Company $company */
        $company = $user->companies()->create([
            'name' => 'admin-prime',
            'company' => 'admin-prime',
            'street' => 'admin',
            'housenr' => 1,
            'postcode' => '1234AA',
            'city' => 'Ede',
            'country' => 'NL',
            'phone' => '06123456789',
            'email' => 'patrick@test.nl',
            'website' => '',
        ]);

        $contact = $company->contacts()->create([
            'name' => 'admin',
            'firstname' => 'admin',
            'middlename' => '',
            'sexe' => 'M',
            'title' => 'admin',
            'street' => 'admin',
            'housenr' => 1,
            'city' => 'Ede',
            'zipcode' => '1234AA',
            'country' => 'NL',
            'phone' => '06123456789',
            'email' => 'patrick@test.nl',
            'fax' => '',
            'remarks' => 'Admin'
        ]);

        $user->contacts()->withTimestamps()->attach($contact->id);
    }
}
