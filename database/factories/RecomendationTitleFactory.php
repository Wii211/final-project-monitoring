<?php

use Faker\Generator as Faker;

$factory->define(App\RecomendationTitle::class, function (Faker $faker) {
    $userId = App\User::pluck('id')->toArray();
    $lecturerId = App\Lecturer::pluck('id')->toArray();
    $finalStudentId = App\FinalStudent::pluck('id')->toArray();

    return [
        'title' => $faker->text($maxNbChars = 30),
        'agree' => $faker->randomElement([1, 0]),
        'user_id' => $faker->randomElement($userId),
        'lecturer_id' => $faker->randomElement($lecturerId),
        'final_student_id' => $faker->randomElement($finalStudentId),
        'description' => $faker->text($maxNbChars = 100)
    ];
});
