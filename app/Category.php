<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

// many to many between category and product
// pivot table required

class Category extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    // category belongs to many products (and product belongs to meny categories - see product model)
    public function products()
    {
        // when many to many use belongsToMany and pivot table
        return $this->belongsToMany(Product::class);
    }
}
