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
        User::create([
                         'username' => 'patrick',
                         'name'     => 'patrick',
                         'email'    => 'patrick@test.nl',
                         'password' => \Hash::make('secret'),
                         'role'     => 'admin',
                         'status'   => 'active',
                     ]);


        // User 2
        User::create([
                         'username' => 'vincent',
                         'name'     => 'vincent',
                         'email'    => 'vin193@hotmail.com',
                         'password' => \Hash::make('secret02'),
                         'role'     => 'manager',
                         'status'   => 'active',
                     ]);

    }
}
