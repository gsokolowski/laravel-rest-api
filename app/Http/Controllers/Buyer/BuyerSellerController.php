<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // http://127.0.0.1:8000/api/buyers/5/sellers
    public function index(Buyer $buyer)
    {
        // you need to look at the db structure to understand relations
        // to get sellers of product buyers you need to go through transactions product to seller

        $sellers = $buyer->transactions()
            ->with('product.seller')
            ->get()
            ->pluck('product.seller')
            ->unique('id')
            ->values();

        return $this->showAll($sellers);

    }

}
