<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Contact;
use App\Services\CompanyService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateClientTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testCreateClient()
    {
        $data = [];

        /** @var \App\Models\Company $company */
        $company = factory(Company::class)->make();
        $data['company'] = $company->toArray();

        $contact = factory(Contact::class)->make();
        $data['contact'] = $contact->toArray();

        $companyService = new CompanyService();
        $companyTest  = $companyService->createWithContactAndUser($data);

        $this->assertTrue($companyTest instanceof Company);
        $this->assertEquals($company->name, $companyTest->name);
    }
}
