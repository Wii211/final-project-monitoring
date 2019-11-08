<?php

use Faker\Generator as Faker;

$factory->define(App\RecomendationTopic::class, function (Faker $faker) {
    $recomendationTitleId = App\RecomendationTitle::pluck('id')->toArray();
    $topicId = App\Topic::pluck('id')->toArray();
    return [
        'recomendation_title_id' => $faker->randomElement($recomendationTitleId),
        'topic_id' => $faker->randomElement($topicId),
    ];
});
