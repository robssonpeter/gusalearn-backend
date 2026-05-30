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
        Schema::table('lessons', function (Blueprint $table) {
            // Column may already exist from a partial prior run; only add if missing
            if (!Schema::hasColumn('lessons', 'module_id')) {
                $table->foreignId('module_id')->nullable()->after('id')
                      ->constrained()->nullOnDelete();
            } else {
                // Column exists — just add the FK constraint
                $table->foreign('module_id')->references('id')->on('modules')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeign(['module_id']);
            $table->dropColumn('module_id');
        });
    }
};
