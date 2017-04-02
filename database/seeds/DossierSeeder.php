<?php

use Illuminate\Database\Seeder;

class DossierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i<50;$i++) {
            $user = factory(App\User::class)->create();
            $company = factory(App\Company::class)->create();

            factory(App\Contact::class)->create(['company_id' => $company->id]);
            $dossier = factory(App\Dossier::class)->create();

            $user->companies()->attach($company->id);
            $dossier->companies()->attach($company->id);

        }
    }
}
