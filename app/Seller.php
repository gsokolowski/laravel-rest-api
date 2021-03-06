<?php

namespace App;

use App\Product;
use App\Scopes\SellerScope;

class Seller extends User
{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SellerScope);
    }

    // seller has many product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
