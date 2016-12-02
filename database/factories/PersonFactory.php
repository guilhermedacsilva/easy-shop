<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(EasyShop\Model\Person::class, function (Faker\Generator $faker) {

    return [
        'name' => str_random(10),
        'type' => EasyShop\Model\Person::TYPE_CUSTOMER,
        'created_at' => $faker->dateTime(),
    ];
}, 'customer');

$factory->define(EasyShop\Model\Person::class, function (Faker\Generator $faker) {

    return [
        'name' => str_random(10),
        'type' => EasyShop\Model\Person::TYPE_SUPPLIER,
        'created_at' => $faker->dateTime(),
    ];
}, 'supplier');
