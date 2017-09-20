<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Get list of products bought by buyer.
    // It goes through transaction table, but buyer to transaction is one to many relation
    // so you will get a collection of transactions and will need to go one by one to get a product
    public function index(Buyer $buyer)
    {
        //print_r($buyer);
        // if you do this you will get error
        // Property [product] does not exist on this collection instance because result of transaction is a collection
        // and not one transaction - buyer can have meny transaction so collection is returned
        // to this will not work
        // $buyerProducts = $buyer->transactions->product;

        // you need to use eager loading to obtain product with every transaction
        // call method transactions() instead of relationship and
        // this will return transaction with product added into product key in json
        $buyerTransactionsWithProducts = $buyer->transactions()->with('product')->get();

        // if you need only list of buyers products you need to do this
        // add pluck method and the key you need - here will be product

        $buyerProducts = $buyer->transactions()
                                ->with('product')
                                ->get()
                                ->pluck('product');
        return $this->showAll($buyerProducts);

    }
}
