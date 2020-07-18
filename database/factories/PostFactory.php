<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\User;
use Faker\Generator as Faker;

$factory->define(\App\Post::class, function (Faker $faker) {
    return [
        'body'    => $faker->sentence,
        'user_id' => factory(User::class)->create(),
        'image'  => 'https://i.pinimg.com/originals/ca/76/0b/ca760b70976b52578da88e06973af542.jpg'
    ];
});
