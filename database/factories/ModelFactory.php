<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Master\Category::class, function(Faker\Generator $faker) {
  return [
    'code' => $faker->randomNumber,
    'name' => $faker->unique()->randomElement(['man', 'ladies', 'clothing', 'shoes', 'accesories']),
    'parent_id' => 0,
  ];
});

$factory->define(App\Models\Master\Product::class, function(Faker\Generator $faker) {
  return [
    'category_id' => App\Models\Master\Category::orderByRaw('RAND()')->first()->id,
    'sku' => $faker->randomNumber(5),
    'name' => $faker->sentence(4),
    'is_display' => true,
    'price' => $faker->randomNumber(6),
    'description' => $faker->paragraph(10),
    'stock' => $faker->randomNumber(2)
  ];
});

$factory->define(App\Models\Master\Image::class, function(Faker\Generator $faker) {
  return [
    'product_id' => App\Models\Master\Product::orderByRaw('RAND()')->first()->id,
    'path' => $faker->imageUrl(450, 600),
    'type' => $faker->randomElement(['front', 'back']),
    'position' => $faker->randomNumber(2)
  ];
});

$factory->define(App\Models\Master\DeliveryMethod::class, function(Faker\Generator $faker) {
  return [
    'code' => $faker->randomNumber(5),
    'name' => $faker->sentence(3),
    'description' => $faker->paragraph(10),
    'fee' => $faker->randomNumber(6),
    'estimated_time' => $faker->randomNumber(2),
    'image' => $faker->imageUrl(450, 600),
    'main' => false
  ];
});

$factory->define(App\Models\Master\PaymentMethod::class, function(Faker\Generator $faker) {
  return [
    'code' => $faker->randomNumber(5),
    'name' => $faker->sentence(3),
    'description' => $faker->paragraph(10),
    'image' => $faker->imageUrl(450, 600),
  ];
});
