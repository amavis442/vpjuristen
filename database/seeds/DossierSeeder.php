<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Dossier;
use App\Models\Action;
use App\Models\Comment;
use App\Models\Invoice;
use App\Models\File as InvoiceFile;




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
            $user = factory(User::class)->create();
            $user->save();
            $user->roles()->save($clientUserRole);

            $company = factory(Company::class)->create();
            $user->companies()->save($company);

            $contact = factory(Contact::class)->create();
            $company->contacts()->save($contact);
            $user->contacts()->attach($contact->id);

            // Debtor
            $userDeb = factory(User::class)->create();
            $userDeb->save();
            $userDeb->roles()->save($clientUserRole);

            $companyDeb = factory(Company::class)->create();
            $userDeb->companies()->save($companyDeb);

            $contactDeb = factory(Contact::class)->create();
            $companyDeb->contacts()->save($contactDeb);
            $userDeb->contacts()->attach($contactDeb->id);

            // Dossier
            $dossier = factory(Dossier::class)->create();
            $user->dossiers()->save($dossier,['type'=>'client']);
            $userDeb->dossiers()->attach($dossier->id,['type'=>'debtor']);

            $company->dossiers()->attach($dossier->id,['type'=>'client']);
            $companyDeb->dossiers()->attach($dossier->id,['type'=>'debtor']);


            // Action
            $action = new Action();
            $action->title = 'First action';
            $action->listaction_id = 1;
            $action->description = '';
            $dossier->actions()->save($action);

            // Comment
            $comment = new Comment();
            $comment->comment = 'Start';
            $action->comments()->save($comment);

            // Invoice
            $invoice = new Invoice();
            $invoice->title = $faker->title;
            $invoice->amount = $faker->numberBetween(10, 4000);
            $invoice->due_date = $faker->dateTimeBetween('-1 years')->format('Y-m-d');
            $invoice->remarks = $faker->paragraph(2);
            $dossier->invoices()->save($invoice);


            // File
            $doc = Illuminate\Http\UploadedFile::fake()->create('test',500);
            $filename = $doc->store('invoices');
            $filename_org = $doc->getClientOriginalName();

            $file = new InvoiceFile();
            $file->filename = $filename;
            $file->filename_org = $filename_org;

            $invoice->files()->save($file);
        }
    }
}
