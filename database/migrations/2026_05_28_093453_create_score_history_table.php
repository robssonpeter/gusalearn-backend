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
        Schema::create('score_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('score');
            $table->unsignedTinyInteger('stars');
            $table->unsignedSmallInteger('timing_score')->nullable();
            $table->enum('mode', ['screen', 'piano']);
            $table->unsignedSmallInteger('xp_earned')->default(0);
            $table->timestamp('played_at');
            $table->timestamps();
            $table->index(['user_id', 'lesson_id', 'played_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_history');
    }
};
