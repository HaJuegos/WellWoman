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
        Schema::create('foros', function (Blueprint $table) {
            $table->id()->autoIncrement()->unique();
            $table->foreignId('user_id')->nullable()->constrained('usuarios')->cascadeOnDelete();
            $table->text('name');
            $table->text('content');
            $table->integer('likes')->default(0);
            $table->integer('reportes')->default(0);
            $table->dateTime('time_creation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foros');
    }
};
