<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WalletController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\OrderController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/wallets', [WalletController::class, 'index']);
    Route::post('/transfer/internal', [TransactionController::class, 'internalTransfer']);
    Route::post('/transfer/external', [TransactionController::class, 'externalTransfer']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
});
