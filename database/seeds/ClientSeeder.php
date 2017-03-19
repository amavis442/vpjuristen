<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Client::class, 50)->create()
            ->each(function ($client) {
            $company_id = factory(App\Company::class)->create(['client_id' => $client->id])->id;
            factory(App\Contact::class)->create(['company_id' => $company_id]);
        });
    }
}
