<?php

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User 1
        $contact = new Contact();
        $contact->name = 'admin';
        $contact->firstname = 'admin';
        $contact->middlename = '';
        $contact->sexe = 'M';
        $contact->title = 'admin';
        $contact->street = 'admin';
        $contact->housenumber = 1;
        $contact->postalcode = '1234AA';
        $contact->city = 'Ede';
        $contact->country = 'NL';
        $contact->phone = '06123456789';
        $contact->email = 'patrick@test.nl';
        $contact->fax = '';
        $contact->remarks = 'Admin';

        $contact->save();
        $contact->users()->attach(1);

        // User 2
        $contact = new Contact();
        $contact->name = 'Teunissen';
        $contact->firstname = 'Vincent';
        $contact->middlename = '';
        $contact->sexe = 'M';
        $contact->title = 'admin';
        $contact->street = 'admin';
        $contact->housenumber = 1;
        $contact->postalcode = '1234AA';
        $contact->city = 'Ede';
        $contact->country = 'NL';
        $contact->phone = '06123456789';
        $contact->email = 'vincent@test.nl';
        $contact->fax = '';
        $contact->remarks = 'Admin';

        $contact->save();
        $contact->users()->attach(2);

    }
}
