<?php

use App\User;
use App\Category;
use App\Product;
use App\Transaction;
use App\Seller;



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

// Faker will generate data for db tables


// User
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),

        'verified' => $verified = $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]), // 0 or 1

        'verification_token' => $verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),

        'admin' => $verified = $faker->randomElement([User::ADMIN_USER, User::REGULAR_USER]), // true or false
    ];
});


// Category - you need only name and one paragraph of description
$factory->define(Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1), // 1 paragraph
    ];
});


// Product
$factory->define(Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity' => $faker->numberBetween(1, 10),
        'status' => $faker->randomElement([Product::AVAILABLE_PRODUCT, Product::UNAVAILABLE_PRODUCT]),
        'image' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg']),
        'seller_id' => User::all()->random()->id,
        // User::inRandomOrder()->first()->id
    ];
});


// Transaction
$factory->define(Transaction::class, function (Faker\Generator $faker) {

    // get all seller products and get() only one random() one
    $seller = Seller::has('products')->get()->random();

    // buyer is all the users except $seller->id and get random
    $buyer = User::all()->except($seller->id)->random();

    return [
        'quantity' => $faker->numberBetween(1, 3),
        'buyer_id' => $buyer->id,
        'product_id' => $seller->products->random()->id, // get seller products and choose one randomly
        // User::inRandomOrder()->first()->id
    ];
});