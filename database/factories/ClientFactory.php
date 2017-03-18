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
$factory->define(App\Client::class, function (Faker\Generator $faker) {

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
        'client_id' => function () {
            return factory(App\Client::class)->create()->id;
        },
        'name' => $faker->lastName,
        'surname' => $faker->firstNameFemale,
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


