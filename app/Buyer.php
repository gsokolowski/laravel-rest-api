<?php

namespace App;

use App\Transaction;

class Buyer extends User
{

    // buyer can have many transactions

    public function transactions() {
        
        //return $this->hasMany('\App\Transactions', 'user_id', 'id');
        return $this->hasMany(Transaction::class);
    }

}
