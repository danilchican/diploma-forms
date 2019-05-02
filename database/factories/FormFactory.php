<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Form::class, function (Faker $faker) {
    return [
        'title'       => $faker->text(80),
        'description' => $faker->text,
        'is_finished' => $faker->boolean,
    ];
});