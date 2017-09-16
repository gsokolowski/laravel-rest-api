<?php

namespace App;

use App\Product;

class Seller extends User
{
    // seller has many product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
