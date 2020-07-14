<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\User;
use Faker\Generator as Faker;

$factory->define(\App\Post::class, function (Faker $faker) {
    return [
        'body'    => $faker->sentence,
        'user_id' => factory(User::class)->create()
    ];
});
