<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'sender_wallet_id', 'receiver_wallet_id', 'external_address',
        'amount', 'type', 'status'
    ];

    public function senderWallet()
    {
        return $this->belongsTo(Wallet::class, 'sender_wallet_id');
    }

    public function receiverWallet()
    {
        return $this->belongsTo(Wallet::class, 'receiver_wallet_id');
    }
}

