<?php

namespace App;

use App\Transaction;
use App\Scopes\BuyerScope;

class Buyer extends User
{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BuyerScope);
    }
    // buyer can have many transactions
    public function transactions() {

        //return $this->hasMany('\App\Transactions', 'user_id', 'id');
        return $this->hasMany(Transaction::class);
    }

}
