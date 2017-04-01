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
        if (!Role::where('name', '=', 'admin')->first()->exists) {
            Role::create(['name' => 'admin', 'description' => 'The administrator of the site']);
            Role::create(['name' => 'debtor', 'description' => 'The one who own money']);
            Role::create(['name' => 'client', 'description' => 'The one who gets the money']);
        }

        if (!User::find(1)->hasRole('admin')) {
            User::find(1)->roles()->withTimestamps()->attach(1);
            User::find(1)->roles()->withTimestamps()->attach(2);
        }
    }
}
