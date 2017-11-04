<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Company;
use App\Models\Contact;

class CreateClientTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        /** @var Company $company */
        $company = factory(Company::class)->make();
        $contact = factory(Contact::class)->make();

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
