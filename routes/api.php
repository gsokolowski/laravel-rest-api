<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//  php artisan route:list

//               url       ControllerName
Route::resource('buyers', 'Buyer\BuyerController', ['only' => ['index', 'show'] ]);
Route::resource('buyers.sellers', 'Buyer\BuyerSellerController', ['only' => ['index'] ]);
Route::resource('buyers.products', 'Buyer\BuyerProductController', ['only' => ['index'] ]);
Route::resource('buyers.categories', 'Buyer\BuyerCategoryController', ['only' => ['index']]);
Route::resource('buyers.transactions', 'Buyer\BuyerTransactionController', ['only' => ['index'] ]);

Route::resource('categories', 'Category\CategoryController', ['except' => ['create', 'edit'] ]);
Route::resource('categories.buyers', 'Category\CategoryBuyerController', ['only' => ['index']]);
Route::resource('categories.products', 'Category\CategoryProductController', ['only' => ['index']]);
Route::resource('categories.sellers', 'Category\CategorySellerController', ['only' => ['index']]);
Route::resource('categories.transactions', 'Category\CategoryTransactionController', ['only' => ['index']]);

Route::resource('products', 'Product\ProductController', ['only' => ['index', 'show'] ]);
Route::resource('products.buyers', 'Product\ProductBuyerController', ['only' => ['index']]);
Route::resource('products.categories', 'Product\ProductCategoryController', ['only' => ['index', 'update', 'destroy']]);
Route::resource('products.transactions', 'Product\ProductTransactionController', ['only' => ['index']]);
Route::resource('products.buyers.transactions', 'Product\ProductBuyerTransactionController', ['only' => ['store']]);

Route::resource('sellers', 'Seller\SellerController', ['only' => ['index', 'show'] ]);
Route::resource('sellers.buyers', 'Seller\SellerBuyerController', ['only' => ['index']]);
Route::resource('sellers.products', 'Seller\SellerProductController', ['except' => ['create', 'show', 'edit']]);
Route::resource('sellers.categories', 'Seller\SellerCategoryController', ['only' => ['index', 'show']]);
Route::resource('sellers.transactions', 'Seller\SellerTransactionController', ['only' => ['index', 'show']]);



Route::resource('transactions', 'Transaction\TransactionController', ['only' => ['index', 'show'] ]);
Route::resource('transactions.categories', 'Transaction\TransactionCategoryController', ['only' => ['index'] ]);
Route::resource('transactions.sellers', 'Transaction\TransactionSellerController', ['only' => ['index'] ]);

Route::resource('users', 'User\UserController', ['except' => ['create', 'edit'] ]);


/**
 *
 *
 * +--------+-----------+--------------------------------+--------------------+--------------------------------------------------------------+------------+
| Domain | Method    | URI                            | Name               | Action                                                       | Middleware |
+--------+-----------+--------------------------------+--------------------+--------------------------------------------------------------+------------+
|        | GET|HEAD  | /                              |                    | Closure                                                      | web        |
|        | GET|HEAD  | api/buyers                     | buyers.index       | App\Http\Controllers\Buyer\BuyerController@index             | api        |
|        | GET|HEAD  | api/buyers/{buyer}             | buyers.show        | App\Http\Controllers\Buyer\BuyerController@show              | api        |
|        | GET|HEAD  | api/categories                 | categories.index   | App\Http\Controllers\Category\CategoryController@index       | api        |
|        | POST      | api/categories                 | categories.store   | App\Http\Controllers\Category\CategoryController@store       | api        |
|        | DELETE    | api/categories/{category}      | categories.destroy | App\Http\Controllers\Category\CategoryController@destroy     | api        |
|        | GET|HEAD  | api/categories/{category}      | categories.show    | App\Http\Controllers\Category\CategoryController@show        | api        |
|        | PUT|PATCH | api/categories/{category}      | categories.update  | App\Http\Controllers\Category\CategoryController@update      | api        |
|        | GET|HEAD  | api/products                   | products.index     | App\Http\Controllers\Product\ProductController@index         | api        |
|        | GET|HEAD  | api/products/{product}         | products.show      | App\Http\Controllers\Product\ProductController@show          | api        |
|        | GET|HEAD  | api/sellers                    | sellers.index      | App\Http\Controllers\Seller\SellerController@index           | api        |
|        | GET|HEAD  | api/sellers/{seller}           | sellers.show       | App\Http\Controllers\Seller\SellerController@show            | api        |
|        | GET|HEAD  | api/transactions               | transactions.index | App\Http\Controllers\Transaction\TransactionController@index | api        |
|        | GET|HEAD  | api/transactions/{transaction} | transactions.show  | App\Http\Controllers\Transaction\TransactionController@show  | api        |
|        | POST      | api/users                      | users.store        | App\Http\Controllers\User\UserController@store               | api        |
|        | GET|HEAD  | api/users                      | users.index        | App\Http\Controllers\User\UserController@index               | api        |
|        | DELETE    | api/users/{user}               | users.destroy      | App\Http\Controllers\User\UserController@destroy             | api        |
|        | PUT|PATCH | api/users/{user}               | users.update       | App\Http\Controllers\User\UserController@update              | api        |
|        | GET|HEAD  | api/users/{user}               | users.show         | App\Http\Controllers\User\UserController@show                | api        |
+--------+-----------+--------------------------------+--------------------+--------------------------------------------------------------+------------+
 */