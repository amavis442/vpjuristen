<?php

use Illuminate\Database\Seeder;

class DebtorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Debtor::class, 50)->create()
        ->each(function ($debtor) {
            $company_id = factory(App\Company::class)->create(['debtor_id' => $debtor->id])->id;
            factory(App\Contact::class)->create(['company_id' => $company_id]);
        });
    }
}
