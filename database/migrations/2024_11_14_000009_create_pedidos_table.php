<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id()->autoIncrement()->unique();
            $table->dateTime('order_date');
            $table->integer('total');
            $table->text('delivery_address');
            $table->text('status');
            $table->foreignId('user_id')->constrained('usuarios')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
