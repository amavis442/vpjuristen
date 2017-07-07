<?php

namespace Tests\Unit;

use App\Services\CompanyService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User;
use App\Models\Company;
use App\Models\Contact;

class CompanyServiceTest extends TestCase
{
    protected $postData;

    public function setUp()
    {
        $this->createApplication();

        $this->postData['client'] = [
            'name' => 'TestCompany' . date('YmdHis'),
            'company' => 'Company',
            'street' => 'TestStreet',
            'housenr' => 1,
            'postcode' => '1234AA',
            'city' => 'Ede',
            'country' => 'NL',
            'phone' => '06123456789',
            'email' => 'test@test.nl',
            'website' => 'http://www.test.nl',
        ];

        $this->postData['contact'] = [
            'sexe' => 'M',
            'firstname' => 'TestName',
            'middlename' => 'none',
            'name' => 'Lastname',
            'email' => 'lastname@test.nl',
            'phone' => '011234568799',
            'zipcode' => '1234AA',
            'street' => 'ContactStreet',
            'housenr' => '1',
            'city' => 'Ede',
            'fax' => '01123456789',
            'country' => 'NL',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }

    public function createClient()
    {
        $postData = $this->postData['client'];

        $company = new Company();
        $company->fill($this->postData['client']);
        $company->save();
        $this->assertInstanceOf('App\Models\Company', $company);

        $contact = new Contact();
        $contact->fill($this->postData['contact']);
        $company->contacts()->save($contact);

        /** @var Contact $contact */
        $contact = $company->contacts()->first();

        $this->assertInstanceOf('App\Models\Contact', $contact);
        $this->assertEquals($postData['contact']['name'], $contact->name);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetClientByUser()
    {
        $user = User::findOrFail(1);
        $company = Company::findOrFail(2);
        $company->users()->save($user);

        $users = $company->users()->get();
        $userCreated = $users->last();

        $this->assertEquals($user->name, $userCreated->name);
    }

}
