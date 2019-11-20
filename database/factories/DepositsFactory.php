<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Deposits;

$factory->define(Deposits::class, function (Faker $faker) {

    return [
        'deposit'   => $faker->numberBetween(2000, 200000)
    ];
});
