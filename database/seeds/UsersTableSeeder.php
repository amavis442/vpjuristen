<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use App\Models\Contact;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User 1
        /** @var User $user */
        $user = User::create([
                                 'name' => 'patrick',
                                 'email' => 'patrick@test.nl',
                                 'password' => \Hash::make('secret'),
                                 'active' => 1
                             ]);

        $role = Role::whereName('admin')->first();
        if (is_null($role)) {
            $user->delete();
            throw new \Exception('Please run the RoleSeeder first');
        }
        $user->roles()->save($role);

        // User 2
        $user = User::create([
            'name' => 'vincent',
            'email' => 'vin193@hotmail.com',
            'password' => \Hash::make('secret02'),
            'active' => 1
        ]);

        if (is_null($role)) {
            $user->delete();
            throw new \Exception('Please run the RoleSeeder first');
        }
        $user->roles()->save($role);
    }
}
