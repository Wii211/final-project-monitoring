<?php

use Faker\Generator as Faker;

$factory->define(App\Lecturer::class, function (Faker $faker) {

    $positionId = App\Position::pluck('id')->toArray();

    return [
        'personnel_id' => $faker->unique()->numerify('################'),
        'lecturer_id' => $faker->unique()->numerify('##########'),
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->unique()->phoneNumber,
        'last_education' => $faker->randomElement(['S2', 'S3']),
        'status' => $faker->randomElement([1, 0]),
        'image_profile' => $faker->imageUrl($width = 640, $height = 480),
        'position_id' =>  $faker->randomElement($positionId),
    ];
});
