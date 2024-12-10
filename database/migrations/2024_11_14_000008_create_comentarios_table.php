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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id()->autoIncrement()->unique();
            $table->foreignId('forum_id')->constrained('foros')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('usuarios')->onDelete('cascade');
            $table->text('content');
            $table->dateTime('date_comment');
            $table->integer('likes')->default(0);
            $table->integer('reports')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
