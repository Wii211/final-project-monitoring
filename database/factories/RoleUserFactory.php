<?php

use Faker\Generator as Faker;

$factory->define(App\RoleUser::class, function (Faker $faker) {
    $userId = App\User::pluck('id')->toArray();
    $roleId = App\Role::pluck('id')->toArray();
    return [
        'role_id' => $faker->randomElement($roleId),
        'user_id' => $faker->randomElement($userId),
    ];
});
