<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id()->autoIncrement()->unique();
            $table->text('name')->nullable();
            $table->text('email');
            $table->text('password')->unique();
            $table->text('profile_url')->nullable()->default("https://i.ibb.co/gwMfpgz/icons8-usuario-femenino-en-c-rculo-100.webp");
            $table->dateTime('last_session');
            $table->dateTime('creation_date');
            $table->text('remember_token')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
