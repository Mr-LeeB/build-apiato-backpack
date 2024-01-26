<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

$factory->define(App\Containers\Product\Models\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'image' => $faker->imageUrl(),
        'user_id' => function () {
            return factory(App\Containers\User\Models\User::class)->create()->id;
        },
    ];
});
