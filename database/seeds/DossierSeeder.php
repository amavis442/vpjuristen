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
            $clientCompany = factory(App\Company::class)->create();

            /** @var Contact $contact */
            $clientContact = factory(App\Contact::class)->create(['company_id' => $clientCompany->id]);
            $clientContact->users()->withTimestamps()->attach($user->id);

            $debtorCompany = factory(App\Company::class)->create();

            /** @var Contact $contact */
            $debtorContact = factory(App\Contact::class)->create(['company_id' => $debtorCompany->id]);

            /** @var Dossier $dossier */
            $dossier = factory(App\Dossier::class)->create(['client_id'=> $clientCompany->id, 'debtor_id' => $debtorCompany->id]);

            $user->companies()->attach($clientCompany->id);
            $dossier->companies()->attach($clientCompany->id);
        }
    }
}
