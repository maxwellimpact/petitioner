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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Petition::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'summary' => $faker->realText(150, 1),
        'body' => $faker->realText(350, 1),
        'published' => $faker->boolean,
        'thanks_message' => $faker->realText(150, 1),
        'thanks_email_subject' => $faker->sentence,
        'thanks_email_body' => $faker->realText(250, 1)
    ];
});

$factory->define(App\Sign::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
    ];
});

$factory->define(App\File::class, function (Faker\Generator $faker) {
    return [
        'url' => $faker->imageUrl(800, 600, 'cats')
    ];
});
