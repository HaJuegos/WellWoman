<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ciclos_menstruales', function (Blueprint $table) {
            $table->id()->autoIncrement()->unique();
            $table->foreignId('user_id')->nullable()->unique()->constrained('usuarios')->cascadeOnDelete();
            $table->date('lastPeriod')->nullable();
            $table->integer('cycle_duration')->nullable();
            $table->integer('period_duration')->nullable();
            $table->boolean('pregnancy_probability')->nullable();
            $table->integer('luteal_phase')->nullable();
            $table->integer('sleep_hours')->nullable();
            $table->integer('water_intake')->nullable();
            $table->integer('step_goal')->nullable();
            $table->integer('desired_weight')->nullable();
            $table->integer('desired_height')->nullable();
            $table->integer('calorie_intake')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciclos_menstruales');
    }
};
