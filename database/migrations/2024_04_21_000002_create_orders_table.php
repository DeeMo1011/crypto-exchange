<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key สำหรับผู้ใช้
            $table->string('order_type'); // ประเภทของคำสั่ง (ซื้อ/ขาย)
            $table->string('fiat_currency'); // สกุลเงิน Fiat ที่ใช้
            $table->string('crypto_currency'); // สกุลเงิน Crypto ที่ใช้
            $table->decimal('amount_fiat', 20, 8); // จำนวนเงิน Fiat
            $table->decimal('amount_crypto', 20, 8); // จำนวนเงิน Crypto
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // สถานะคำสั่งซื้อ
            $table->timestamps(); // เก็บเวลาที่สร้างและอัพเดต
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
