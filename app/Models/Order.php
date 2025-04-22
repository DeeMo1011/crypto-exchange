<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_type', 'fiat_currency', 'crypto_currency',
        'amount_fiat', 'amount_crypto', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
