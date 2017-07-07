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
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = \Hash::make('secret'),
        'active' => true,
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Models\Company::class, function (Faker\Generator $faker) {
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


$factory->define(App\Models\Contact::class, function (Faker\Generator $faker) {
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

$factory->define(App\Models\Dossier::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
        'dossierstatus_id' => 1
    ];
});


$factory->define(App\Models\Invoice::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
        'amount' => $faker->numberBetween(10, 4000),
        'due_date' => $faker->dateTimeBetween('-1 years')->format('Y-m-d'),
        'remarks' => $faker->paragraph(2),
    ];
});
