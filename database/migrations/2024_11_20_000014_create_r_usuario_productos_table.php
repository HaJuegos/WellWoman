<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('r_usuario_productos', function (Blueprint $table) {
            $table->id()->autoIncrement()->unique();
            $table->integer('quantity')->default(0);
            $table->boolean('is_in_cart')->default(false);
            $table->foreignId('user_id')->constrained('usuarios')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('productos')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('r_usuario_productos');
    }
};
