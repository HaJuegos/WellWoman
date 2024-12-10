<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id()->autoIncrement()->unique();
            $table->foreignId('creator_id')->constrained('usuarios')->cascadeOnDelete();
            $table->foreignId('buyer_id')->constrained('usuarios')->cascadeOnDelete();
            $table->dateTime('purchase_date');
            $table->integer('subtotal');
            $table->integer('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
