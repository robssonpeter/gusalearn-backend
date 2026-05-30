<?php

namespace Database\Seeders;

use App\Models\LearningPath;
use Illuminate\Database\Seeder;

class LearningPathSeeder extends Seeder
{
    public function run(): void
    {
        $paths = [
            [
                'order'        => 1,
                'title'        => 'Piano Foundations',
                'subtitle'     => 'Learn the keyboard and basic piano skills',
                'icon'         => '🎹',
                'color_hex'    => '#FF6B5C',
                'is_published' => true,
            ],
            [
                'order'        => 2,
                'title'        => 'Reading Music',
                'subtitle'     => 'Become fluent in sheet music',
                'icon'         => '📖',
                'color_hex'    => '#3FD9A4',
                'is_published' => false,
            ],
            [
                'order'        => 3,
                'title'        => 'Scales & Technique',
                'subtitle'     => 'Develop piano technique and dexterity',
                'icon'         => '🎼',
                'color_hex'    => '#FFC24B',
                'is_published' => false,
            ],
            [
                'order'        => 4,
                'title'        => 'Chords & Harmony',
                'subtitle'     => 'Understand how music is built',
                'icon'         => '🎵',
                'color_hex'    => '#9B6DFF',
                'is_published' => false,
            ],
            [
                'order'        => 5,
                'title'        => 'Playing By Ear',
                'subtitle'     => 'Hear and play music without sheet music',
                'icon'         => '👂',
                'color_hex'    => '#3498DB',
                'is_published' => false,
            ],
            [
                'order'        => 6,
                'title'        => 'Accompaniment & Worship Piano',
                'subtitle'     => 'Play for singers, church, weddings and events',
                'icon'         => '⛪',
                'color_hex'    => '#F39C12',
                'is_published' => false,
            ],
            [
                'order'        => 7,
                'title'        => 'Gospel & Advanced Harmony',
                'subtitle'     => 'Master rich gospel chord language',
                'icon'         => '🎤',
                'color_hex'    => '#27AE60',
                'is_published' => false,
            ],
            [
                'order'        => 8,
                'title'        => 'Improvisation & Creativity',
                'subtitle'     => 'Create your own music freely',
                'icon'         => '✨',
                'color_hex'    => '#E91E8C',
                'is_published' => false,
            ],
            [
                'order'        => 9,
                'title'        => 'Songs Library',
                'subtitle'     => 'Play real songs — beginner to advanced',
                'icon'         => '🎶',
                'color_hex'    => '#1ABC9C',
                'is_published' => false,
            ],
            [
                'order'        => 10,
                'title'        => 'Music Theory Academy',
                'subtitle'     => 'Deep understanding of how music works',
                'icon'         => '📚',
                'color_hex'    => '#3F51B5',
                'is_published' => false,
            ],
            [
                'order'        => 11,
                'title'        => 'Professional Keyboardist',
                'subtitle'     => 'Perform live, play in bands, record and teach',
                'icon'         => '🏆',
                'color_hex'    => '#E74C3C',
                'is_published' => false,
            ],
        ];

        foreach ($paths as $path) {
            LearningPath::updateOrCreate(['order' => $path['order']], $path);
        }
    }
}
