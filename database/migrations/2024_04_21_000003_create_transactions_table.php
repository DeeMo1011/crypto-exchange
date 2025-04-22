<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // auto-increment primary key
            $table->foreignId('sender_wallet_id')->constrained('wallets')->onDelete('cascade');
            $table->foreignId('receiver_wallet_id')->nullable()->constrained('wallets')->onDelete('cascade');
            $table->string('external_address')->nullable();
            $table->decimal('amount', 20, 8); // ไม่ต้องใช้ notNull()
            $table->enum('type', ['buy', 'sell', 'internal_transfer', 'external_transfer']);
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
