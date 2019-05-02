<?php

use Faker\Generator as Faker;

$factory->define(App\Models\FormQuestion::class, function (Faker $faker) {
    return [
        'title'       => $faker->title,
        'is_required' => $faker->boolean,
    ];
});