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
        Schema::create('lesson_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('display_order')->default(0);
            $table->enum('section_type', ['content', 'practice', 'quiz', 'practical', 'music_activity']);
            $table->unsignedSmallInteger('xp_reward')->default(0);
            $table->json('data');
            $table->timestamps();

            $table->index(['lesson_id', 'display_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_sections');
    }
};
