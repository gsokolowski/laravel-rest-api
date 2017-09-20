<?php

namespace App;

use App\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// many to many between category and product
// pivot table required

class Category extends Model
{
    // for sof deleting - build in laravel feature
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'description'
    ];

    protected $hidden = [
        'pivot' // to remove pivot table data from category controllers results - you need to put the same hidden to product model
    ];

    // category belongs to many products (and product belongs to meny categories - see product model)
    public function products()
    {
        // when many to many use belongsToMany and pivot table
        return $this->belongsToMany(Product::class);
    }
}
