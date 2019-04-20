<?php

use Faker\Generator as Faker;

$factory->define(App\Models\AnswerType::class, function (Faker $faker) {
    return [
        'title'            => $faker->title,
        'type'             => $faker->word,
        'answers_required' => $faker->boolean,
    ];
});