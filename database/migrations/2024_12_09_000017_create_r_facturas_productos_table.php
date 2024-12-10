<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('r_facturas_productos', function (Blueprint $table) {
            $table->id()->autoIncrement()->unique();
            $table->foreignId('factura_id')->constrained('facturas')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('productos')->cascadeOnDelete();
            $table->integer('quantity');
            $table->integer('price');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('r_facturas_productos');
    }
};
