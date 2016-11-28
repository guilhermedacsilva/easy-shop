<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(EasyShop\Model\ProductMovement::class, function (Faker\Generator $faker) {
    return [
        'quantity' => $faker->randomFloat(2, 0, 100),
        'total_value' => $faker->randomFloat(2, 0, 100),
        'type' => EasyShop\Model\ProductMovement::TYPE_INPUT,
        'product_id' => 1,
        'created_by' => 1,
    ];
});
