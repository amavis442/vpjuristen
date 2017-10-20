<?php

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = new Company();
        $company->name = 'admin-prime';
        $company->street = 'admin';
        $company->housenr = 1;
        $company->postcode = '1234AA';
        $company->city = 'Ede';
        $company->country = 'NL';
        $company->phone = '06123456789';
        $company->email = 'patrick@test.nl';
        $company->website = '';
        $company->save();

        $company->users()->attach(1);
        $company->users()->attach(2);

    }
}
