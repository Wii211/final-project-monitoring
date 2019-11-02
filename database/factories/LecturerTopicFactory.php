<?php

use Faker\Generator as Faker;

$factory->define(App\LecturerTopic::class, function (Faker $faker) {

    $lecturerId = App\Lecturer::pluck('id')->toArray();

    $topicId = App\Topic::pluck('id')->toArray();

    return [
        'lecturer_id' => $faker->randomElement($lecturerId),
        'topic_id' => $faker->randomElement($topicId),
    ];
});
