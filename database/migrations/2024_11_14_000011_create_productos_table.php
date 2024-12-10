<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id()->autoIncrement()->unique();
            $table->text('name');
            $table->text('description');
            $table->integer('price');
            $table->integer('oldprice')->default('0');
            $table->integer('stock');
            $table->text('category');
            $table->text('mark');
            $table->text('image_url');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
