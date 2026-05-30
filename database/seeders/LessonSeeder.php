<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        // All current lessons belong to Path 1 / Module 1 (Meet Your Piano)
        $module1 = Module::where('module_code', 'PF-M1')->first();

        $lessons = [
            [
                'order'         => 1,
                'title'         => 'Meet Middle C',
                'description'   => 'Find and play your first note',
                'note_sequence' => ['C4'],
                'tempo_target'  => null,
                'mode_support'  => 'both',
                'xp_completion' => 50,
                'xp_perfect'    => 20,
                'is_published'  => true,
                'is_free'       => true,
            ],
            [
                'order'         => 2,
                'title'         => 'Meet the White Keys',
                'description'   => 'Learn C, D, E, F and G',
                'note_sequence' => ['C4', 'D4', 'E4', 'F4', 'G4'],
                'tempo_target'  => 60,
                'mode_support'  => 'both',
                'xp_completion' => 50,
                'xp_perfect'    => 20,
                'is_published'  => true,
                'is_free'       => true,
            ],
            [
                'order'         => 3,
                'title'         => 'Your First Tune',
                'description'   => 'Play a simple 3-note melody',
                'note_sequence' => ['C4', 'D4', 'E4'],
                'tempo_target'  => 70,
                'mode_support'  => 'both',
                'xp_completion' => 50,
                'xp_perfect'    => 20,
                'is_published'  => true,
                'is_free'       => false,
            ],
            [
                'order'         => 4,
                'title'         => 'High Notes',
                'description'   => 'Explore A, B and high C',
                'note_sequence' => ['A4', 'B4', 'C5'],
                'tempo_target'  => 70,
                'mode_support'  => 'both',
                'xp_completion' => 60,
                'xp_perfect'    => 25,
                'is_published'  => true,
                'is_free'       => false,
            ],
            [
                'order'         => 5,
                'title'         => 'Full Octave',
                'description'   => 'Play all 8 notes of the C scale',
                'note_sequence' => ['C4', 'D4', 'E4', 'F4', 'G4', 'A4', 'B4', 'C5'],
                'tempo_target'  => 80,
                'mode_support'  => 'both',
                'xp_completion' => 70,
                'xp_perfect'    => 30,
                'is_published'  => true,
                'is_free'       => false,
            ],
        ];

        foreach ($lessons as $lesson) {
            $lesson['module_id'] = $module1?->id;
            Lesson::updateOrCreate(['order' => $lesson['order']], $lesson);
        }
    }
}
