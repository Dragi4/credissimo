<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Accounts;

$factory->define(Accounts::class, function (Faker $faker) {

    return [
        'name'  => $faker->userName,
        'bank_account'  => $faker->bankAccountNumber
    ];
});
