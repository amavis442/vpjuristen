<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Dossier::class, function (Faker\Generator $faker) {
    return [
        'debtor_id' => function () {
            $company = factory(App\Company::class)->create();
            $contact = factory(App\Contact::class)->create(['company_id' => $company->id]);
            $debtor = factory(App\Debtor::class)->create(['company_id' => $company->id]);
            return $debtor->id;

        },
        'client_id' => function () {
            $company_id = factory(App\Company::class)->create()->id;
            $client = factory(App\Client::class)->create(['company_id' => $company_id]);
            factory(App\Contact::class)->create(['company_id' => $company_id]);
            return $client->id;
        },
        'title' => $faker->title,
    ];
});


$factory->define(App\Debtor::class, function (Faker\Generator $faker) {
    return [];
});


$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [];
});


$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'company' => $faker->word,
        'street' => $faker->streetName,
        'housenr' => $faker->buildingNumber,
        'postcode' => $faker->postcode,
        'city' => $faker->city,
        'country' => $faker->country,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'website' => $faker->url,
    ];
});


$factory->define(App\Contact::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->lastName,
        'firstname' => $faker->firstNameFemale,
        'middlename' => 'van den',
        'sexe' => 'V',
        'title' => $faker->title,
        'street' => $faker->streetName,
        'housenr' => $faker->buildingNumber,
        'city' => $faker->city,
        'zipcode' => $faker->postcode,
        'country' => $faker->country,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'fax' => $faker->url,
        'remarks' => $faker->paragraph
    ];
});
