<?php

namespace App;

use App\Buyer;
use App\Product;


use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'quantity',
        'buyer_id',
        'product_id',
    ];

    // transaction belongs to buyer
    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    // transaction belongs to product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
