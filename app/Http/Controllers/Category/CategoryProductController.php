<?php
namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoryProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // get all products of a category
    // http://127.0.0.1:8000/api/categories/2/products
    public function index(Category $category)
    {
        $products = $category->products;
        return $this->showAll($products);
    }
}