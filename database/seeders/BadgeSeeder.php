<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            ['key' => 'first_lesson',  'title' => 'First Step',    'description' => 'Completed your first lesson',        'icon' => '🎹'],
            ['key' => 'streak_3',      'title' => 'On a Roll',     'description' => '3-day practice streak',              'icon' => '🔥'],
            ['key' => 'streak_7',      'title' => 'Unstoppable',   'description' => '7-day practice streak',              'icon' => '⚡'],
            ['key' => 'perfect_score', 'title' => 'Flawless',      'description' => 'Score 100% on any lesson',           'icon' => '⭐'],
            ['key' => 'piano_first',   'title' => 'Piano Player',  'description' => 'Completed a lesson in Piano mode',   'icon' => '🎵'],
            ['key' => 'all_stars',     'title' => 'Star Collector','description' => 'Earned 3 stars on all lessons',      'icon' => '🏆'],
        ];

        foreach ($badges as $badge) {
            Badge::updateOrCreate(['key' => $badge['key']], $badge);
        }
    }
}
