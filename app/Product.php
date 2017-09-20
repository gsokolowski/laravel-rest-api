<?php

namespace App;

use App\Seller;
use App\Category;
use App\Transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    // for sof deleting - build in laravel feature
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id',
    ];

    protected $hidden = [
        'pivot' // to remove pivot table data from category controllers results - you need to put the same hidden to product model
    ];

    public function isAvailable()
    {
        //return $this->status == Product::AVAILABLE_PRODUCT;

        if($this->status == Product::AVAILABLE_PRODUCT) {
            return true;
        }
    }

    // product belongs to meny categories (and category belongs to many products - see category model)
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // product belongs to only to one seller
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    // product has many transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


}
