<?php

return [
    /*
    |--------------------------------------------------------------------------
    | XP Thresholds & Level Names
    |--------------------------------------------------------------------------
    | Each entry: [min_xp, name]. Levels are assigned by finding the highest
    | threshold the user's XP meets or exceeds.
    */
    'levels' => [
        1 => ['min_xp' => 0,    'name' => 'Note Finder'],
        2 => ['min_xp' => 200,  'name' => 'Note Explorer'],
        3 => ['min_xp' => 500,  'name' => 'Key Walker'],
        4 => ['min_xp' => 900,  'name' => 'Melody Maker'],
        5 => ['min_xp' => 1400, 'name' => 'Rhythm Keeper'],
        6 => ['min_xp' => 2000, 'name' => 'Chord Builder'],
        7 => ['min_xp' => 2800, 'name' => 'Scale Master'],
        8 => ['min_xp' => 3800, 'name' => 'Harmony Seeker'],
    ],
];
