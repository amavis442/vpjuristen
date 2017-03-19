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
$factory->defineAs(App\Client::class, 'client', function (Faker\Generator $faker) {
    return [
    ];
});


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->defineAs(App\Company::class, 'client', function (Faker\Generator $faker) {

    return [
        'client_id' => function () {
            return factory(App\Client::class, 'client')->create()->id;
        },
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


$factory->defineAs(App\Contact::class, 'client', function (Faker\Generator $faker) {

    return [
        'company_id' => function () {
            return factory(App\Company::class)->create()->id;
        },
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


