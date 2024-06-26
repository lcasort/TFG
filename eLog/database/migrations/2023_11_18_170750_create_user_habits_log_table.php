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
        Schema::create('user_habits_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_habit_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->timestamps();
            $table->unique(['user_habit_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_habits_log');
    }
};
