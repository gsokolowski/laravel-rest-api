<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoryBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // get all buyers by selected category
    // http://127.0.0.1:8000/api/categories/2/buyers

    public function index(Category $category)
    {
        $buyers = $category->products()
            ->whereHas('transactions') // after this line we have only product with least one transaction
            ->with('transactions.buyer') // get buyer of every transactions transactions.buyer
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer')
            ->unique('id')
            ->values();

        return $this->showAll($buyers);
    }
}