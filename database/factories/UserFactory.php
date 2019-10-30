<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'user_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->phoneNumber,
        'password' => bcrypt(12345),
        'remember_token' => Str::random(10),
        'image_profile' => $faker->imageUrl($width = 640, $height = 480),
        'gender' => $faker->randomElement(['Laki-Laki', 'Perempuan']),
    ];
});

// $table->increments('id');
// $table->string('user_name');
// $table->string('email')->unique()->nullable();
// $table->string('phone_number')->nullable();
// $table->string('gender');
// $table->string('password');
// $table->rememberToken();
// $table->timestamps();
