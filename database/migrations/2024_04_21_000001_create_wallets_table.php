<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id(); // auto-increment primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('currency');
            $table->decimal('balance', 20, 8)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallets');
    }
};
