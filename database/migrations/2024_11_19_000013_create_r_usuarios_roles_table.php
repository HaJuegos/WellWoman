<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('r_usuarios_roles', function (Blueprint $table) {
            $table->id()->autoIncrement()->unique();
            $table->foreignId('user_id')->constrained('usuarios')->cascadeOnDelete();
            $table->foreignId('rol_id')->constrained('roles')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('r_usuarios_roles');
    }
};
