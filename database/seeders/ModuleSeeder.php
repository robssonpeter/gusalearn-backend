<?php

namespace Database\Seeders;

use App\Models\LearningPath;
use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            // ── Path 1: Piano Foundations ──────────────────────────────────
            ['path' => 1, 'order' => 1, 'code' => 'PF-M1', 'title' => 'Meet Your Piano',
             'description' => 'Learn the keyboard layout, note names, and find Middle C',
             'published' => true],
            ['path' => 1, 'order' => 2, 'code' => 'PF-M2', 'title' => 'Finger Control & Hand Position',
             'description' => 'Build correct posture, finger numbering, and independence',
             'published' => false],
            ['path' => 1, 'order' => 3, 'code' => 'PF-M3', 'title' => 'Rhythm Basics',
             'description' => 'Understand beat, note values, and metronome practice',
             'published' => false],
            ['path' => 1, 'order' => 4, 'code' => 'PF-M4', 'title' => 'First Songs',
             'description' => 'Convert notes and rhythm into real music performance',
             'published' => false],

            // ── Path 2: Reading Music ──────────────────────────────────────
            ['path' => 2, 'order' => 1, 'code' => 'RM-M1', 'title' => 'Treble Clef',
             'description' => 'Staff lines, spaces, and treble notes',
             'published' => false],
            ['path' => 2, 'order' => 2, 'code' => 'RM-M2', 'title' => 'Bass Clef',
             'description' => 'Bass staff lines, spaces, and bass notes',
             'published' => false],
            ['path' => 2, 'order' => 3, 'code' => 'RM-M3', 'title' => 'Reading Fluency',
             'description' => 'Note recognition, sight reading, and rhythm reading',
             'published' => false],
            ['path' => 2, 'order' => 4, 'code' => 'RM-M4', 'title' => 'Reading Songs',
             'description' => 'Apply reading skills to beginner and intermediate songs',
             'published' => false],

            // ── Path 3: Scales & Technique ────────────────────────────────
            ['path' => 3, 'order' => 1, 'code' => 'ST-M1', 'title' => 'Major Scales',
             'description' => 'C, G, D, A, E, F major scales with scale challenge',
             'published' => false],
            ['path' => 3, 'order' => 2, 'code' => 'ST-M2', 'title' => 'Minor Scales',
             'description' => 'Natural, harmonic, and melodic minor scales',
             'published' => false],
            ['path' => 3, 'order' => 3, 'code' => 'ST-M3', 'title' => 'Technical Exercises',
             'description' => 'Finger drills, speed, accuracy, and coordination',
             'published' => false],

            // ── Path 4: Chords & Harmony ──────────────────────────────────
            ['path' => 4, 'order' => 1, 'code' => 'CH-M1', 'title' => 'Intervals',
             'description' => 'Understand major and minor intervals',
             'published' => false],
            ['path' => 4, 'order' => 2, 'code' => 'CH-M2', 'title' => 'Major Chords',
             'description' => 'Build triads and practice root position',
             'published' => false],
            ['path' => 4, 'order' => 3, 'code' => 'CH-M3', 'title' => 'Minor Chords',
             'description' => 'Minor triads and practice',
             'published' => false],
            ['path' => 4, 'order' => 4, 'code' => 'CH-M4', 'title' => 'Chord Inversions',
             'description' => 'First and second inversion, smooth voice movement',
             'published' => false],
            ['path' => 4, 'order' => 5, 'code' => 'CH-M5', 'title' => 'Chord Progressions',
             'description' => 'I-IV-V, I-V-vi-IV, ii-V-I with practice songs',
             'published' => false],

            // ── Path 5: Playing By Ear ────────────────────────────────────
            ['path' => 5, 'order' => 1, 'code' => 'BE-M1', 'title' => 'Ear Training Basics',
             'description' => 'High vs low, same vs different, interval recognition',
             'published' => false],
            ['path' => 5, 'order' => 2, 'code' => 'BE-M2', 'title' => 'Chord Recognition',
             'description' => 'Major, minor, and seventh chords by ear',
             'published' => false],
            ['path' => 5, 'order' => 3, 'code' => 'BE-M3', 'title' => 'Melody Recognition',
             'description' => 'Simple melodies and song fragments by ear',
             'published' => false],
            ['path' => 5, 'order' => 4, 'code' => 'BE-M4', 'title' => 'Playing By Ear',
             'description' => 'Find melody, add chords, play complete songs',
             'published' => false],

            // ── Path 6: Accompaniment & Worship Piano ─────────────────────
            ['path' => 6, 'order' => 1, 'code' => 'WP-M1', 'title' => 'The Number System',
             'description' => 'Scale degrees, 1 chord, 4 chord, 5 chord',
             'published' => false],
            ['path' => 6, 'order' => 2, 'code' => 'WP-M2', 'title' => 'Common Progressions',
             'description' => '1-4-5, 1-5-6-4, 6-2-5-1 in all keys',
             'published' => false],
            ['path' => 6, 'order' => 3, 'code' => 'WP-M3', 'title' => 'Worship Styles',
             'description' => 'Slow worship, praise style, contemporary worship',
             'published' => false],
            ['path' => 6, 'order' => 4, 'code' => 'WP-M4', 'title' => 'Accompaniment Patterns',
             'description' => 'Block chords, broken chords, rhythmic patterns',
             'published' => false],
            ['path' => 6, 'order' => 5, 'code' => 'WP-M5', 'title' => 'Playing With Singers',
             'description' => 'Following a vocalist, key changes, song endings',
             'published' => false],

            // ── Path 7: Gospel & Advanced Harmony ────────────────────────
            ['path' => 7, 'order' => 1, 'code' => 'GA-M1', 'title' => 'Seventh Chords',
             'description' => 'Major 7, minor 7, dominant 7 chords',
             'published' => false],
            ['path' => 7, 'order' => 2, 'code' => 'GA-M2', 'title' => 'Extended Chords',
             'description' => '9th, 11th, 13th chords',
             'published' => false],
            ['path' => 7, 'order' => 3, 'code' => 'GA-M3', 'title' => 'Passing Chords',
             'description' => 'Chromatic and diatonic passing chords',
             'published' => false],
            ['path' => 7, 'order' => 4, 'code' => 'GA-M4', 'title' => 'Reharmonization',
             'description' => 'Substitute chords and advanced reharmonization',
             'published' => false],
            ['path' => 7, 'order' => 5, 'code' => 'GA-M5', 'title' => 'Gospel Progressions',
             'description' => 'Classic gospel chord movements and turns',
             'published' => false],

            // ── Path 8: Improvisation & Creativity ───────────────────────
            ['path' => 8, 'order' => 1, 'code' => 'IC-M1', 'title' => 'Improvisation Basics',
             'description' => 'Scales, motifs, and call-and-response',
             'published' => false],
            ['path' => 8, 'order' => 2, 'code' => 'IC-M2', 'title' => 'Pentatonic Scales',
             'description' => 'Major and minor pentatonic for improvisation',
             'published' => false],
            ['path' => 8, 'order' => 3, 'code' => 'IC-M3', 'title' => 'Blues Concepts',
             'description' => 'Blues scale, shuffle feel, 12-bar blues',
             'published' => false],
            ['path' => 8, 'order' => 4, 'code' => 'IC-M4', 'title' => 'Creating Fills',
             'description' => 'Riffs, runs, and fills between phrases',
             'published' => false],
            ['path' => 8, 'order' => 5, 'code' => 'IC-M5', 'title' => 'Soloing',
             'description' => 'Full solo construction over chord progressions',
             'published' => false],

            // ── Path 9: Songs Library ─────────────────────────────────────
            ['path' => 9, 'order' => 1, 'code' => 'SL-M1', 'title' => 'Beginner Songs',
             'description' => 'Simple melodies for new players',
             'published' => false],
            ['path' => 9, 'order' => 2, 'code' => 'SL-M2', 'title' => 'Classical',
             'description' => 'Classical pieces adapted for learning',
             'published' => false],
            ['path' => 9, 'order' => 3, 'code' => 'SL-M3', 'title' => 'Worship & Gospel',
             'description' => 'Church worship songs and gospel standards',
             'published' => false],
            ['path' => 9, 'order' => 4, 'code' => 'SL-M4', 'title' => 'African Songs',
             'description' => 'East African and Swahili songs',
             'published' => false],
            ['path' => 9, 'order' => 5, 'code' => 'SL-M5', 'title' => 'Pop & Wedding',
             'description' => 'Popular songs and wedding music',
             'published' => false],

            // ── Path 10: Music Theory Academy ─────────────────────────────
            ['path' => 10, 'order' => 1, 'code' => 'MT-M1', 'title' => 'Keys & Key Signatures',
             'description' => 'Major and minor keys, sharps and flats',
             'published' => false],
            ['path' => 10, 'order' => 2, 'code' => 'MT-M2', 'title' => 'Circle of Fifths',
             'description' => 'The circle of fifths and key relationships',
             'published' => false],
            ['path' => 10, 'order' => 3, 'code' => 'MT-M3', 'title' => 'Chord Functions',
             'description' => 'Tonic, subdominant, and dominant functions',
             'published' => false],
            ['path' => 10, 'order' => 4, 'code' => 'MT-M4', 'title' => 'Song Analysis',
             'description' => 'Analyse real songs using theory concepts',
             'published' => false],
            ['path' => 10, 'order' => 5, 'code' => 'MT-M5', 'title' => 'Composition Basics',
             'description' => 'Write your own melodies and chord progressions',
             'published' => false],

            // ── Path 11: Professional Keyboardist ────────────────────────
            ['path' => 11, 'order' => 1, 'code' => 'PK-M1', 'title' => 'Band Playing',
             'description' => 'Playing with drummers, bassists, and singers',
             'published' => false],
            ['path' => 11, 'order' => 2, 'code' => 'PK-M2', 'title' => 'Arranging',
             'description' => 'Arranging songs for keyboard and ensemble',
             'published' => false],
            ['path' => 11, 'order' => 3, 'code' => 'PK-M3', 'title' => 'Live Performance',
             'description' => 'Stage mindset, dynamics, and emotional expression',
             'published' => false],
            ['path' => 11, 'order' => 4, 'code' => 'PK-M4', 'title' => 'Transposition',
             'description' => 'Playing songs in any key on request',
             'published' => false],
            ['path' => 11, 'order' => 5, 'code' => 'PK-M5', 'title' => 'Keyboard Setup',
             'description' => 'Sounds, layers, splits, and pedal use',
             'published' => false],
            ['path' => 11, 'order' => 6, 'code' => 'PK-M6', 'title' => 'MIDI Basics',
             'description' => 'MIDI, DAWs, and keyboard controllers',
             'published' => false],
            ['path' => 11, 'order' => 7, 'code' => 'PK-M7', 'title' => 'Recording',
             'description' => 'Home recording, loops, and production basics',
             'published' => false],
        ];

        foreach ($modules as $data) {
            $path = LearningPath::where('order', $data['path'])->first();
            if (!$path) continue;

            Module::updateOrCreate(
                ['learning_path_id' => $path->id, 'order' => $data['order']],
                [
                    'module_code'  => $data['code'],
                    'title'        => $data['title'],
                    'description'  => $data['description'],
                    'is_published' => $data['published'],
                ]
            );
        }
    }
}
