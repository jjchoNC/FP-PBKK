<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionProduct extends Model
{
    protected $fillable = ['transaction_id', 'product_id'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}