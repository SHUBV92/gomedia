<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Books::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'Author' => $faker->text(200),

    ];
});
