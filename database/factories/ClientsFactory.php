<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Clients;

$factory->define(Clients::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
