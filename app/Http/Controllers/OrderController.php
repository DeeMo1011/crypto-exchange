<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return Order::where('status', 'open')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_type' => 'required|in:buy,sell',
            'fiat_currency' => 'required',
            'crypto_currency' => 'required',
            'amount_fiat' => 'required|numeric',
            'amount_crypto' => 'required|numeric',
        ]);

        $order = Order::create([
            'user_id' => $request->user()->id,
            'order_type' => $request->order_type,
            'fiat_currency' => $request->fiat_currency,
            'crypto_currency' => $request->crypto_currency,
            'amount_fiat' => $request->amount_fiat,
            'amount_crypto' => $request->amount_crypto,
            'status' => 'open',
        ]);

        return response()->json($order);
    }
}
