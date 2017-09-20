<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;


// php artisan make:controller Transaction/TransactionCategoryController -r -m Transaction
// using model Transaction
class TransactionCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // get list of categories for specific transaction so it needs to go through product
    // http://127.0.0.1:8000/api/transactions/12/categories
    // will return a list of product categories for particular transaction through product as product is related to categories
    public function index(Transaction $transaction)
    {
        // print_r($transaction->product_id);
        // print_r($transactionProductCategories);
        // dd($transaction);

        // this is like join in sql
        // transaction has product and product has categores
        // so
        $transactionProductCategories = $transaction->product->categories;
        return $this->showAll($transactionProductCategories, 200); // using trait

    }
}
