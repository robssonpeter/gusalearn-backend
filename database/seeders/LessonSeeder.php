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

        // Lessons 6 & 7 belong to PF-M2 (Finger Control & Hand Position)
        $module2 = Module::where('module_code', 'PF-M2')->first();
        Lesson::updateOrCreate(['order' => 6], [
            'title'         => 'Right Hand Position',
            'title_sw'      => 'Nafasi ya Mkono wa Kulia',
            'description'   => 'Learn the five-finger system and C major right-hand position',
            'description_sw'=> 'Jifunza mfumo wa vidole vitano na nafasi ya mkono wa kulia',
            'note_sequence' => ['C4', 'D4', 'E4', 'F4', 'G4'],
            'tempo_target'  => 60,
            'mode_support'  => 'both',
            'xp_completion' => 70,
            'xp_perfect'    => 30,
            'is_published'  => true,
            'is_free'       => false,
            'module_id'     => $module2?->id,
        ]);

        Lesson::updateOrCreate(['order' => 7], [
            'title'         => 'Left Hand Position',
            'title_sw'      => 'Nafasi ya Mkono wa Kushoto',
            'description'   => 'Learn the left-hand five-finger position from C3 to G3',
            'description_sw'=> 'Jifunza nafasi ya vidole vitano vya mkono wa kushoto kutoka C3 hadi G3',
            'note_sequence' => ['C3', 'D3', 'E3', 'F3', 'G3'],
            'tempo_target'  => 60,
            'mode_support'  => 'both',
            'xp_completion' => 70,
            'xp_perfect'    => 30,
            'is_published'  => true,
            'is_free'       => false,
            'module_id'     => $module2?->id,
        ]);

        // Lessons 8 & 9: full-octave C major scale, right and left hand
        Lesson::updateOrCreate(['order' => 8], [
            'title'         => 'Right Hand: Full Scale',
            'title_sw'      => 'Mkono wa Kulia: Ngazi Nzima',
            'description'   => 'Play the C major scale C4–C5 with the thumb-tuck technique',
            'description_sw'=> 'Piga ngazi ya C major C4–C5 kwa mbinu ya kidole gumba kupita chini',
            'note_sequence' => ['C4', 'D4', 'E4', 'F4', 'G4', 'A4', 'B4', 'C5'],
            'tempo_target'  => 60,
            'mode_support'  => 'both',
            'xp_completion' => 80,
            'xp_perfect'    => 35,
            'is_published'  => true,
            'is_free'       => false,
            'module_id'     => $module2?->id,
        ]);

        Lesson::updateOrCreate(['order' => 9], [
            'title'         => 'Left Hand: Full Scale',
            'title_sw'      => 'Mkono wa Kushoto: Ngazi Nzima',
            'description'   => 'Play the C major scale C3–C4 with the finger-crossing technique',
            'description_sw'=> 'Piga ngazi ya C major C3–C4 kwa mbinu ya kidole kupita juu',
            'note_sequence' => ['C3', 'D3', 'E3', 'F3', 'G3', 'A3', 'B3', 'C4'],
            'tempo_target'  => 60,
            'mode_support'  => 'both',
            'xp_completion' => 80,
            'xp_perfect'    => 35,
            'is_published'  => true,
            'is_free'       => false,
            'module_id'     => $module2?->id,
        ]);
    }
}
