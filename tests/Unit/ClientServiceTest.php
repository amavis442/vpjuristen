<?php

namespace Tests\Unit;

use App\Domain\Services\Client\ClientService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Company;
use App\Contact;

class ClientServiceTest extends TestCase
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
        $postData = $this->postData;

        $client = new ClientService();
        $data = $client->create($postData);
        $this->assertInstanceOf('App\Company', $data);

        /** @var Company $company */
        $company = $data;
        /** @var Contact $contact */
        $contact = $company->contacts()->first();

        $this->assertInstanceOf('App\Contact', $contact);
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

        $client = new ClientService($user);
        $client->setUser($user);

        $company = $client->getClient();
        $this->assertInstanceOf('App\Company', $company);
    }

    public function testGetClientById()
    {
        $client = new ClientService();

        $company = $client->getClient(1);
        $this->assertInstanceOf('App\Company', $company);
    }


    public function testUpdateByArray()
    {
        $postData = $this->postData;
        $postData['client']['id'] = 1;

        $client = new ClientService();
        $company = $client->update($postData['client']);

        $this->assertEquals($postData['client']['name'], $company->name);
    }
}
