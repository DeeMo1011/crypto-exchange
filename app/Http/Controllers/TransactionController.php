<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function internalTransfer(Request $request)
    {
        $request->validate([
            'from_wallet_id' => 'required|exists:wallets,id',
            'to_wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|min:0.0001',
        ]);

        DB::beginTransaction();

        try {
            $from = Wallet::lockForUpdate()->find($request->from_wallet_id);
            $to = Wallet::lockForUpdate()->find($request->to_wallet_id);

            if ($from->balance < $request->amount) {
                return response()->json(['error' => 'Insufficient balance'], 400);
            }

            $from->balance -= $request->amount;
            $to->balance += $request->amount;
            $from->save();
            $to->save();

            Transaction::create([
                'sender_wallet_id' => $from->id,
                'receiver_wallet_id' => $to->id,
                'amount' => $request->amount,
                'type' => 'internal_transfer',
                'status' => 'completed',
            ]);

            DB::commit();
            return response()->json(['message' => 'Transfer successful']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Transfer failed'], 500);
        }
    }

    public function externalTransfer(Request $request)
    {
        $request->validate([
            'from_wallet_id' => 'required|exists:wallets,id',
            'external_address' => 'required|string',
            'amount' => 'required|numeric|min:0.0001',
        ]);

        $wallet = Wallet::findOrFail($request->from_wallet_id);
        if ($wallet->balance < $request->amount) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        }

        $wallet->balance -= $request->amount;
        $wallet->save();

        Transaction::create([
            'sender_wallet_id' => $wallet->id,
            'external_address' => $request->external_address,
            'amount' => $request->amount,
            'type' => 'external_transfer',
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Transfer initiated']);
    }
}
