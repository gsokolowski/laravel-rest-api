<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;


class BuyerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // get all cetegories where buyer has done eny purchace
    // http://127.0.0.1:8000/api/buyers/5/categories
    public function index(Buyer $buyer)
    {
        // explained here in detail
        // https://www.udemy.com/restful-api-with-laravel-php-homestead-passport-hateoas/learn/v4/t/lecture/6952426?start=0

        $buyerCategories = $buyer->transactions()->with('product.categories')
            ->get()
            ->pluck('product.categories') // needs to be categories not category because it is many to many and this is collection. List of categories is inside product key
            ->collapse() // to remove nested collections inside collection
            ->unique('id') // it works like distinct in sql
            ->values(); // to remove empty categories when repeated

        return $this->showAll($buyerCategories);
    }
}
