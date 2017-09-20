<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // List transaction for specific buyer, returns buyer transactions
    // http://127.0.0.1:8000/api/buyers/5/transactions
    public function index(Buyer $buyer)
    {
        $buyerTransactions = $buyer->transactions;
        return $this->showAll($buyerTransactions);
    }
}
