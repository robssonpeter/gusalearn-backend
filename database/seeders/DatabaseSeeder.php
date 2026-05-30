<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LearningPathSeeder::class,  // paths first
            ModuleSeeder::class,        // modules second (depend on paths)
            LessonSeeder::class,        // lessons third (depend on modules)
            BadgeSeeder::class,
            LessonSectionSeeder::class,
        ]);
    }
}
