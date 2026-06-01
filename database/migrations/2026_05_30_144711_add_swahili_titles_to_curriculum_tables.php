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
        Schema::table('learning_paths', function (Blueprint $table) {
            $table->string('title_sw')->nullable()->after('title');
            $table->string('subtitle_sw')->nullable()->after('subtitle');
        });

        Schema::table('modules', function (Blueprint $table) {
            $table->string('title_sw')->nullable()->after('title');
            $table->string('description_sw')->nullable()->after('description');
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->string('title_sw')->nullable()->after('title');
            $table->string('description_sw')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('learning_paths', function (Blueprint $table) {
            $table->dropColumn(['title_sw', 'subtitle_sw']);
        });
        Schema::table('modules', function (Blueprint $table) {
            $table->dropColumn(['title_sw', 'description_sw']);
        });
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn(['title_sw', 'description_sw']);
        });
    }
};
