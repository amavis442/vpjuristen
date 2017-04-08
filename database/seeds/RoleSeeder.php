<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin', 'description' => 'The administrator of the site']);
        Role::create(['name' => 'debtor', 'description' => 'The one who own money']);
        Role::create(['name' => 'client', 'description' => 'The one who gets the money']);
        Role::create(['name' => 'prospect', 'description' => 'A new client that has to be checked out first']);
        Role::create(['name' => 'employee', 'description' => 'Employee who has access to dossiers of clients']);
    }
}
