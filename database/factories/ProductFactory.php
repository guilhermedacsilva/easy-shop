<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(EasyShop\Model\Product::class, function (Faker\Generator $faker) {

    return [
        'name' => str_random(10),
        'quantity' => $faker->randomFloat(2, 0, 100),
        'created_at' => $faker->dateTime(),
        'created_by' => 1,
    ];
});
