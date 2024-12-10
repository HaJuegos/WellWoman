<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('r_foros_usuarios', function (Blueprint $table) {
            $table->id()->autoIncrement()->unique();
            $table->foreignId('user_id')->constrained('usuarios')->cascadeOnDelete();
            $table->foreignId('foro_id')->constrained('foros')->cascadeOnDelete();
            $table->boolean('has_like')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_foros_usuarios');
    }
};
