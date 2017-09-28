<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Company;

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
        $company = factory(Company::class)->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Dossier aanmelden')
            ->assertSee('Zipcode');
        });
    }
}
