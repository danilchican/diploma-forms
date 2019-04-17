<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Role::class, function (Faker $faker) {
    return [
        'title' => 'Sample Role Name',
        'slug' => 'sample-role-slug',
    ];
});

$factory->state(\App\Models\Role::class, 'admin', [
    'title' => 'Администратор',
    'slug'  => 'admin',
]);
