<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;


// php artisan make:controller Category/CategoryTransactionController -r -m Category
class CategoryTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // get all transactions by selected category
    // http://127.0.0.1:8000/api/categories/2/transactions
    public function index(Category $category)
    {
        $transactions = $category->products()
            ->whereHas('transactions') // after this line we have only product with least one transaction
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();

        return $this->showAll($transactions);
    }
}