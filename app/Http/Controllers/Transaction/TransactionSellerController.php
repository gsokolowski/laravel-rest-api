<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TransactionSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // get me a seller of particular transaction (it will be one seller)
    // http://127.0.0.1:8000/api/transactions/12/sellers
    // will return seller model (one) of that particular transaction through product of transaction as product is related with seller
    public function index(Transaction $transaction)
    {
        $transactionSeller = $transaction->product->seller;
        return $this->showOne($transactionSeller, 200); // using trait
    }
}
