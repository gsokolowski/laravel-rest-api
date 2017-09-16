<?php


use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // To be able to run and seed DB wih data
        // you need to have setup in database/factories/ModelFactory.php
        // then:

        // - disable database FOREIGN_KEY_CHECKS
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // - clear truncate whole DB for the project through model class
        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();

        // - trancate pivot table but through DB facade - there is no  category_product model - it is pivot table
        // so you need to access directly db table using DB Facade
        DB::table('category_product')->truncate();

        // now set how meny od users categories products you need to insert to db
        $usersQuantity = 200;
        $categoriesQuantity = 30;
        $productsQuantity = 1000;
        $transactionsQuantity = 1000;

        // use factory to create inserts
        factory(User::class, $usersQuantity)->create(); // create() is to store data in db
        factory(Category::class, $categoriesQuantity)->create();

        // each product needs to have 1 to 5 random categories
        factory(Product::class, $productsQuantity)->create()->each(

            function ($product) {

                $categories = Category::all()->random(mt_rand(1, 5))->pluck('id'); // pluck will pick up only category id
                // attach($categories) (array of categories to product category column)
                // one product can have 1 to 5 random cetegories
                $product->categories()->attach($categories);
            });

        factory(Transaction::class, $transactionsQuantity)->create();
    }
}
