<?php

namespace App;

use App\Buyer;
use App\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    // for sof deleting - build in laravel feature
    use SoftDeletes;
    protected $dates = ['deleted_at'];

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
