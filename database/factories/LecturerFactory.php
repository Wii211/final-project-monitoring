<?php

use Faker\Generator as Faker;

$factory->define(App\Lecturer::class, function (Faker $faker) {
    return [
        'personnel_id' => $faker->unique()->randomNumber($nbDigits = 18),
        'lecturer_id' => $faker->unique()->randomNumber($nbDigits = 10),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->unique()->phoneNumber,
        'last_education' => $faker->randomElement(['S2', 'S3']),
        'image_profile' => $faker->imageUrl($width = 640, $height = 480),
    ];
});
