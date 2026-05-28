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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order')->unique();
            $table->string('title');
            $table->string('description');
            $table->json('note_sequence');
            $table->unsignedSmallInteger('tempo_target')->nullable();
            $table->enum('mode_support', ['both', 'screen_only'])->default('both');
            $table->unsignedSmallInteger('xp_completion')->default(50);
            $table->unsignedSmallInteger('xp_perfect')->default(20);
            $table->boolean('is_published')->default(false);
            $table->boolean('is_free')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
