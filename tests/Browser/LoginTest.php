<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Company;
use App\Models\Contact;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        /** @var Company $company */
        $company = factory(Company::class)->create();
        $contact = factory(Contact::class)->create();

        $this->browse(function (Browser $browser) use ($company, $contact) {
            $browser->visit('/')
                    ->clickLink('Dossier aanmelden')
                    ->type('company[name]', $company->name)
                    ->type('company[street]', $company->street)
                    ->type('company[housenr]', $company->housenr)
                    ->type('company[postcode]', $company->postcode)
                    ->type('company[city]', $company->city)
                    ->type('company[country]', $company->country)
                    ->type('company[phone]', $company->phone)
                    ->type('company[email]', $company->email)
                    ->type('company[website]', $company->website)

                    ->radio('contact[sexe]', 'M')
                    ->type('contact[firstname]', $contact->firstname)
                    ->type('contact[middlename]', $contact->middlename)
                    ->type('contact[name]', $contact->name)
                    ->type('contact[phone]', $contact->phone)
                    ->type('contact[email]', $contact->email)
                    ->click('#btnSubmit')
                    ->assertSee('Zipcode');
        });
    }
}
