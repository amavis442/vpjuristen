<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Company;
use App\Contact;
use App\Dossier;

class DossierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            /** @var \App\User $user */
            $user = factory(App\User::class)->create();
            /** @var Role $role */
            $role = Role::where(['name' => 'prospect'])->get()->first();
            $user->roles()->withTimestamps()->attach($role->id);
            /** @var Company $company */
            $company = factory(App\Company::class)->create();

            /** @var Contact $contact */
            $contact = factory(App\Contact::class)->create(['company_id' => $company->id]);
            $contact->users()->withTimestamps()->attach($user->id);

            /** @var Dossier $dossier */
            $dossier = factory(App\Dossier::class)->create();

            $user->companies()->attach($company->id);
            $dossier->companies()->attach($company->id);

        }
    }
}
