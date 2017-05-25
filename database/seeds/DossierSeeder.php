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
        $clientUserRoleId = Role::where(['name' => 'prospect'])->get()->first()->id;
        for ($i = 0; $i < 50; $i++) {
            $currentTimestamp = date('Y-m-d H:i:s');

            /**
             * This part simulates what happens in \App\Frontend\ClientController::store()
             */

            /** @var Company $company */
            $clientCompany = factory(App\Company::class)->create();
            /** @var Contact $contact */
            $clientContact = factory(App\Contact::class)->create(['company_id' => $clientCompany->id]);

            $userData = [];
            $userData['name'] = $clientContact->name;
            $userData['email'] = $clientContact->email;
            $userData['password'] = bcrypt('secret');
            $userData['active'] = 1;
            $userData['status'] = 'pending';
            $userData['created_at'] = $currentTimestamp;
            $userData['updated_at'] = $currentTimestamp;

            /** @var User $user */
            $user = $clientCompany->users()->withTimestamps()->create($userData);
            $user->roles()->withTimestamps()->attach($clientUserRoleId);

            $clientContact->users()->withTimestamps()->attach($user->id);

            /**
             * This part simulates what happens in \App\Frontend\DebtorController::store()
             */
            $debtorCompany = factory(App\Company::class)->create();

            /** @var Contact $contact */
            $debtorContact = factory(App\Contact::class)->create(['company_id' => $debtorCompany->id]);


            /**
             * This part simulates \App\Frontend\DossierController::store()
             */
            /** @var Dossier $dossier */
            $dossier = factory(App\Dossier::class)->create(['client_id'=> $clientCompany->id, 'debtor_id' => $debtorCompany->id]);

            $invoice = factory(App\Invoice::class)->create(['dossier_id' => $dossier->id]);

            $doc = Illuminate\Http\UploadedFile::fake()->create('test',500);
            $filename = $doc->store('invoices');
            $filename_org = $doc->getClientOriginalName();
            $invoice->files()->withTimestamps()->create(['filename' => $filename, 'filename_org' => $filename_org]);

            $dossier->companies()->attach($clientCompany->id);
            $dossier->companies()->attach($debtorCompany->id);
        }
    }
}
