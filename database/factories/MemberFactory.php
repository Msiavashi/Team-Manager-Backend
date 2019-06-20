<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName('male'),
        'last_name' => $faker->lastName(),
        'email' => $faker->unique()->safeEmail
    ];
});
