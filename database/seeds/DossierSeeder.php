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
        $faker = Faker\Factory::create();

        $clientUserRole = Role::where(['name' => 'prospect'])->get()->first();
        for ($i = 0; $i < 50; $i++) {
            $currentTimestamp = \Carbon\Carbon::now();

            // Client
            /** @var Company $company */
            $user = factory(App\User::class)->create();
            $user->save();
            $user->roles()->save($clientUserRole);

            $company = factory(App\Company::class)->create();
            $user->companies()->save($company);
            $contact = factory(App\Contact::class)->create();
            $company->contacts()->save($contact);
            $user->contacts()->save($contact);
            $company->contacts()->withTimestamps()->attach($contact->id);

            // Debtor
            $userDeb = factory(App\User::class)->create();
            $userDeb->save();
            $userDeb->roles()->save($clientUserRole);

            $companyDeb = factory(App\Company::class)->create();
            $userDeb->companies()->save($companyDeb);
            $contactDeb = factory(App\Contact::class)->create();
            $companyDeb->contacts()->save($contactDeb);
            $userDeb->contacts()->save($contactDeb);
            $companyDeb->contacts()->withTimestamps()->attach($contactDeb->id);

            // Dossier
            $dossier = factory(App\Dossier::class)->create();
            $user->dossiers()->save($dossier,['type'=>'client']);
            $userDeb->dossiers()->withTimeStamps()->attach($dossier->id,['type'=>'debtor']);

            $company->dossiers()->withTimestamps()->attach($dossier->id,['type'=>'client']);
            $companyDeb->dossiers()->withTimestamps()->attach($dossier->id,['type'=>'debtor']);


            // Action
            $action = new \App\Action();
            $action->title = 'First action';
            $action->listaction_id = 1;
            $action->description = '';
            $dossier->actions()->save($action);

            // Comment
            $comment = new App\Comment();
            $comment->comment = 'Start';
            $action->comments()->save($comment);

            // Invoice
            $invoice = new App\Invoice();
            $invoice->title = $faker->title;
            $invoice->amount = $faker->numberBetween(10, 4000);
            $invoice->due_date = $faker->dateTimeBetween('-1 years')->format('Y-m-d');
            $invoice->remarks = $faker->paragraph(2);
            $dossier->invoices()->save($invoice);


            // File
            $doc = Illuminate\Http\UploadedFile::fake()->create('test',500);
            $filename = $doc->store('invoices');
            $filename_org = $doc->getClientOriginalName();

            $file = new \App\File();
            $file->filename = $filename;
            $file->filename_org = $filename_org;

            $invoice->files()->save($file);
        }
    }
}
