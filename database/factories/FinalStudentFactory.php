<?php

use Faker\Generator as Faker;

$factory->define(App\FinalStudent::class, function (Faker $faker) {
    $userId = App\User::pluck('id')->toArray();

    return [
        'name' => $faker->name,
        'transcript' => $faker->imageUrl($width = 640, $height = 480),
        'student_id' => $faker->unique()->numerify('##########'),
        'status' => $faker->randomElement([1, 0]),
        'is_verified' => $faker->randomElement([1, 0]),
        'user_id' => $faker->randomElement($userId),
        'latest_study_plan' => $faker->imageUrl($width = 640, $height = 480),
    ];
});
