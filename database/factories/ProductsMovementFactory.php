<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(EasyShop\Model\ProductsMovement::class, function (Faker\Generator $faker) {
    return [
        'quantity' => $faker->randomFloat(2, 0, 100),
        'total_value' => $faker->randomFloat(2, 0, 100),
        'type' => EasyShop\Model\ProductsMovement::TYPE_INPUT,
        'product_id' => 1,
        'created_by' => 1,
    ];
});
