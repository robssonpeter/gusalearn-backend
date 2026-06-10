<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\LessonSection;
use Illuminate\Database\Seeder;

class LessonSectionSeeder extends Seeder
{
    public function run(): void
    {
        $lesson1 = Lesson::where('order', 1)->first();
        if (!$lesson1) {
            return;
        }

        // Update Lesson 1 to full curriculum XP
        $lesson1->update(['xp_completion' => 80, 'xp_perfect' => 20]);

        // ── Section 1: Content (read topics) ──────────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson1->id, 'display_order' => 1],
            [
                'section_type' => 'content',
                'xp_reward'    => 20,
                'data'         => [
                    'topics' => [
                        [
                            'title_en'  => 'The Piano Keyboard',
                            'title_sw'  => 'Kibodi cha Piano',
                            'body_en'   => "The piano has two types of keys: white keys and black keys.\n\nThe black keys are arranged in a repeating pattern across the entire keyboard:\n\n  ⬛⬛  ⬛⬛⬛  ⬛⬛  ⬛⬛⬛\n\n• A group of 2 black keys\n• A group of 3 black keys\n• …and so on, repeating\n\nThis pattern is your map for navigating the keyboard.",
                            'body_sw'   => "Piano ina aina mbili za vitufe: vitufe vya nyeupe na vitufe vya nyeusi.\n\nVitufe vya nyeusi vimepangwa katika muundo unaokurudia katika kibodi nzima:\n\n  ⬛⬛  ⬛⬛⬛  ⬛⬛  ⬛⬛⬛\n\n• Kikundi cha vitufe 2 vya nyeusi\n• Kikundi cha vitufe 3 vya nyeusi\n• …na kuendelea, ukiwa unarudiwa\n\nMuundo huu ni ramani yako ya kuelekeza kwenye kibodi.",
                            'visual'    => [
                                'type' => 'keyboard_pattern',
                            ],
                        ],
                        [
                            'title_en'  => 'Finding the Note C',
                            'title_sw'  => 'Kutafuta Noti ya C',
                            'body_en'   => "Here is the one rule you must memorise:\n\n🎹  C is always the white key directly to the LEFT of any group of 2 black keys.\n\nHow to find C:\n1. Spot a group of 2 black keys\n2. Move one key to the left\n3. That white key is C!\n\nThis rule works anywhere on the keyboard — there is a C before every group of 2.",
                            'body_sw'   => "Hii ndiyo kanuni moja unayohitaji kukumbuka:\n\n🎹  C daima ni kitufe nyeupe kilicho moja kwa moja KUSHOTO mwa kikundi chochote cha vitufe 2 vya nyeusi.\n\nJinsi ya kupata C:\n1. Tafuta kikundi cha vitufe 2 vya nyeusi\n2. Sogea kitufe kimoja kushoto\n3. Kitufe hicho nyeupe ndiyo C!\n\nKanuni hii inafanya kazi mahali popote kwenye kibodi — kuna C kabla ya kila kikundi cha 2.",
                            'visual'    => [
                                'type'       => 'highlight_keys',
                                'keys'       => ['C'],
                                'labels'     => ['C' => 'C'],
                                'caption_en' => 'C sits immediately to the left of 2 black keys',
                                'caption_sw' => 'C iko kushoto mwa vitufe 2 vya nyeusi',
                            ],
                        ],
                        [
                            'title_en'  => 'Middle C',
                            'title_sw'  => 'C ya Kati',
                            'body_en'   => "Middle C is the C note closest to the centre of the keyboard.\n\nWhy is it special?\n• It is the starting point for most beginners\n• It serves as a reference for reading music\n• It connects what your right and left hands play\n\nIn this app, Middle C is labelled C4. It is the very first note you will learn to play.",
                            'body_sw'   => "C ya Kati ni noti ya C iliyo karibu zaidi na katikati ya kibodi.\n\nKwa nini ni maalum?\n• Ni mahali pa kuanzia kwa wanafunzi wengi\n• Inatumika kama sehemu ya marejeleo kusoma muziki\n• Inaunganisha kinachochezwa na mkono wa kulia na wa kushoto\n\nKatika programu hii, C ya Kati inaitwa C4. Ndiyo noti ya kwanza kabisa utakayojifunza kupiga.",
                            'visual'    => [
                                'type'       => 'highlight_keys',
                                'keys'       => ['C'],
                                'labels'     => ['C' => 'Middle C'],
                                'caption_en' => 'Middle C — your starting reference point',
                                'caption_sw' => 'C ya Kati — sehemu yako ya kuanzia',
                            ],
                        ],
                    ],
                ],
            ]
        );

        // Shift quiz from order 2 → 3 and music_activity from 3 → 4
        LessonSection::where('lesson_id', $lesson1->id)
            ->where('display_order', 3)
            ->where('section_type', 'music_activity')
            ->update(['display_order' => 4]);

        LessonSection::where('lesson_id', $lesson1->id)
            ->where('display_order', 2)
            ->where('section_type', 'quiz')
            ->update(['display_order' => 3]);

        // ── Section 2: Practice (keyboard exercises) ──────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson1->id, 'display_order' => 2],
            [
                'section_type' => 'practice',
                'xp_reward'    => 30,
                'data'         => [
                    'exercises' => [
                        [
                            'type'          => 'single_note',
                            'prompt_en'     => 'Find and tap the C note',
                            'prompt_sw'     => 'Tafuta na gusa kitufe cha C',
                            'target_notes'  => ['C'],
                            'success_count' => 8,
                            'xp'            => 15,
                        ],
                        [
                            'type'          => 'note_sequence',
                            'prompt_en'     => 'Play the notes in order',
                            'prompt_sw'     => 'Piga noti kwa mpangilio',
                            'target_notes'  => ['C4', 'D4', 'E4', 'D4', 'C4'],
                            'success_count' => 1,
                            'xp'            => 15,
                        ],
                    ],
                ],
            ]
        );

        // ── Section 3: Quiz (check understanding) ────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson1->id, 'display_order' => 3],
            [
                'section_type' => 'quiz',
                'xp_reward'    => 30,
                'data'         => [
                    'passing_pct' => 67,
                    'questions'   => [
                        [
                            'question_en'   => 'Where is C located on the keyboard?',
                            'question_sw'   => 'C ipo wapi kwenye kibodi?',
                            'options_en'    => ['To the left of 2 black keys', 'To the left of 3 black keys', 'Between the black keys'],
                            'options_sw'    => ['Kushoto mwa vitufe 2 vya nyeusi', 'Kushoto mwa vitufe 3 vya nyeusi', 'Kati ya vitufe vya nyeusi'],
                            'correct_index' => 0,
                        ],
                        [
                            'question_en'   => 'What pattern do the black keys repeat in?',
                            'question_sw'   => 'Muundo gani wa vitufe vya nyeusi unarudiwa?',
                            'options_en'    => ['Groups of 2 only', 'Groups of 3 only', 'Groups of 2 and 3'],
                            'options_sw'    => ['Vikundi vya 2 peke yake', 'Vikundi vya 3 peke yake', 'Vikundi vya 2 na 3'],
                            'correct_index' => 2,
                        ],
                        [
                            'question_en'   => 'Which note is directly to the left of a group of 2 black keys?',
                            'question_sw'   => 'Noti gani iko moja kwa moja kushoto mwa kikundi cha vitufe 2 vya nyeusi?',
                            'options_en'    => ['D', 'C', 'E'],
                            'options_sw'    => ['D', 'C', 'E'],
                            'correct_index' => 1,
                        ],
                    ],
                ],
            ]
        );

        $this->seedLesson6();
        $this->seedLesson7();
        $this->seedLesson8();
        $this->seedLesson9();

        // ── Section 4: Music Activity ─────────────────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson1->id, 'display_order' => 4],
            [
                'section_type' => 'music_activity',
                'xp_reward'    => 10,
                'data'         => [
                    'title_en'        => 'My First Piano Sound',
                    'title_sw'        => 'Sauti Yangu ya Kwanza ya Piano',
                    'instructions_en' => "Now let's make music!\n\nFind the C key on your keyboard and tap it. Listen to the sound.\n\nTry this simple pattern:\nC — C — C — C\n\nThen try this:\nC — C — C — C — C — C\n\nYou are already making music! 🎵\n\nPlay freely for a moment, then tap Finish Lesson when you're ready.",
                    'instructions_sw' => "Sasa tufanye muziki!\n\nTafuta kitufe cha C kwenye kibodi yako na uguse. Sikiliza sauti.\n\nJaribu muundo huu rahisi:\nC — C — C — C\n\nKisha jaribu huu:\nC — C — C — C — C — C\n\nUnafanya muziki tayari! 🎵\n\nCheza kwa uhuru kwa muda, kisha gusa Maliza Somo utakapokuwa tayari.",
                    'target_note'     => 'C',
                ],
            ]
        );
    }

    private function seedLesson8(): void
    {
        $lesson = Lesson::where('order', 8)->first();
        if (!$lesson) return;

        $lesson->update(['xp_completion' => 90, 'xp_perfect' => 25]);

        // ── Section 1: Content ────────────────────────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson->id, 'display_order' => 1],
            [
                'section_type' => 'content',
                'xp_reward'    => 25,
                'data'         => [
                    'topics' => [
                        [
                            'title_en' => 'The C Major Scale',
                            'title_sw' => 'Ngazi ya C Major',
                            'body_en'  => "The C major scale uses all eight white keys from one C to the next:\n\nC  D  E  F  G  A  B  C\n\nYou already know the first five (C to G) from your five-finger position. Now you'll extend through A, B, and the high C.\n\nThe full right-hand finger pattern is:\n\n1 – 2 – 3 – 1 – 2 – 3 – 4 – 5\n\nNotice that finger 1 (thumb) appears twice — once on C and once on F. This switch is called the thumb tuck.",
                            'body_sw'  => "Ngazi ya C major inatumia vitufe vyote vinane vya nyeupe kutoka C moja hadi kinachofuata:\n\nC  D  E  F  G  A  B  C\n\nUnajua tayari vitano vya kwanza (C hadi G) kutoka nafasi yako ya vidole vitano. Sasa utaendelea kupitia A, B, na C ya juu.\n\nMuundo kamili wa vidole vya mkono wa kulia ni:\n\n1 – 2 – 3 – 1 – 2 – 3 – 4 – 5\n\nAngalia kwamba kidole 1 (gumba) kinaonekana mara mbili — mara moja kwenye C na mara moja kwenye F. Mabadiliko haya yanaitwa kidole gumba kupita chini.",
                            'visual'   => [
                                'type'       => 'highlight_keys',
                                'keys'       => ['C', 'D', 'E', 'F', 'G', 'A', 'B', 'C5'],
                                'labels'     => ['C' => '1', 'D' => '2', 'E' => '3', 'F' => '1', 'G' => '2', 'A' => '3', 'B' => '4', 'C5' => '5'],
                                'caption_en' => 'Right hand: full C major scale fingering',
                                'caption_sw' => 'Mkono wa kulia: vidole vya ngazi nzima ya C major',
                            ],
                        ],
                        [
                            'title_en' => 'The Thumb Tuck',
                            'title_sw' => 'Kidole Gumba Kupita Chini',
                            'body_en'  => "After playing E with finger 3, you need to swing your thumb (finger 1) silently UNDER your middle finger so it lands on F — just as finger 3 lifts off E.\n\nHow to practise:\n1. Play C–D–E slowly (fingers 1–2–3)\n2. While finger 3 is still on E, begin moving your thumb under toward F\n3. As you lift finger 3, press F with your thumb\n4. Continue: G (2) – A (3) – B (4) – C (5)\n\nThe wrist should stay level — no jumping or twisting.",
                            'body_sw'  => "Baada ya kupiga E kwa kidole 3, unahitaji kupeleka gumba lako (kidole 1) kwa utulivu CHINI ya kidole cha kati ili liweke F — wakati kidole 3 kinaondoka E.\n\nJinsi ya kufanya mazoezi:\n1. Piga C–D–E polepole (vidole 1–2–3)\n2. Kidole 3 kikiwa bado kwenye E, anza kuhamisha gumba lako chini kuelekea F\n3. Ukiinua kidole 3, bonyeza F kwa gumba lako\n4. Endelea: G (2) – A (3) – B (4) – C (5)\n\nMkono uwe sawa — usiruke wala kupinda.",
                            'visual'   => [
                                'type'       => 'finger_map',
                                'hand'       => 'right',
                                'fingering'  => [
                                    ['finger' => 1, 'label_en' => 'C / F', 'label_sw' => 'C / F'],
                                    ['finger' => 2, 'label_en' => 'D / G', 'label_sw' => 'D / G'],
                                    ['finger' => 3, 'label_en' => 'E / A', 'label_sw' => 'E / A'],
                                    ['finger' => 4, 'label_en' => 'B',     'label_sw' => 'B'],
                                    ['finger' => 5, 'label_en' => 'C5',    'label_sw' => 'C5'],
                                ],
                                'caption_en' => 'Thumb plays C then tucks under to play F',
                                'caption_sw' => 'Gumba linapiga C kisha kupita chini kupiga F',
                            ],
                        ],
                        [
                            'title_en' => 'Descending: Finger Crossover',
                            'title_sw' => 'Kushuka: Kidole Kupita Juu',
                            'body_en'  => "Coming back down from C5 to C4, the finger pattern reverses:\n\n5 – 4 – 3 – 2 – 1 – 3 – 2 – 1\n\nAfter your thumb plays F (position 1 in the second group), finger 3 crosses OVER the thumb to land on E, allowing your hand to shift back to the starting position.\n\nFull descending: C5(5) B(4) A(3) G(2) F(1) E(3) D(2) C4(1)\n\nPractise ascending and descending slowly, keeping an even tone on every note.",
                            'body_sw'  => "Kurudi chini kutoka C5 hadi C4, mfumo wa vidole unabadilika:\n\n5 – 4 – 3 – 2 – 1 – 3 – 2 – 1\n\nBaada ya gumba lako kupiga F (nafasi ya 1 katika kundi la pili), kidole 3 kinapita JUU ya gumba kuweka E, ikiruhusu mkono wako kurudi nafasi ya kuanza.\n\nKushuka kamili: C5(5) B(4) A(3) G(2) F(1) E(3) D(2) C4(1)\n\nFanya mazoezi ya kupanda na kushuka polepole, ukishika sauti sawa kwenye kila noti.",
                            'visual'   => [
                                'type'       => 'highlight_keys',
                                'keys'       => ['C5', 'B', 'A', 'G', 'F', 'E', 'D', 'C'],
                                'labels'     => ['C5' => '5', 'B' => '4', 'A' => '3', 'G' => '2', 'F' => '1', 'E' => '3', 'D' => '2', 'C' => '1'],
                                'caption_en' => 'Right hand descending: 5 4 3 2 1 — then 3 2 1',
                                'caption_sw' => 'Mkono wa kulia kushuka: 5 4 3 2 1 — kisha 3 2 1',
                            ],
                        ],
                    ],
                ],
            ]
        );

        // ── Section 2: Practice ───────────────────────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson->id, 'display_order' => 2],
            [
                'section_type' => 'practice',
                'xp_reward'    => 35,
                'data'         => [
                    'exercises' => [
                        [
                            'type'            => 'note_sequence',
                            'prompt_en'       => 'Right hand up: C D E F G A B C  (1 2 3 1 2 3 4 5)',
                            'prompt_sw'       => 'Mkono wa kulia juu: C D E F G A B C  (1 2 3 1 2 3 4 5)',
                            'target_notes'    => ['C4','D4','E4','F4','G4','A4','B4','C5'],
                            'finger_sequence' => [1,2,3,1,2,3,4,5],
                            'success_count'   => 2,
                            'xp'              => 18,
                        ],
                        [
                            'type'            => 'note_sequence',
                            'prompt_en'       => 'Right hand down: C B A G F E D C  (5 4 3 2 1 3 2 1)',
                            'prompt_sw'       => 'Mkono wa kulia chini: C B A G F E D C  (5 4 3 2 1 3 2 1)',
                            'target_notes'    => ['C5','B4','A4','G4','F4','E4','D4','C4'],
                            'finger_sequence' => [5,4,3,2,1,3,2,1],
                            'success_count'   => 2,
                            'xp'              => 17,
                        ],
                    ],
                ],
            ]
        );

        // ── Section 3: Quiz ───────────────────────────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson->id, 'display_order' => 3],
            [
                'section_type' => 'quiz',
                'xp_reward'    => 30,
                'data'         => [
                    'passing_pct' => 67,
                    'questions'   => [
                        [
                            'question_en'   => 'In the right-hand C major scale, which finger plays F (the thumb-tuck note)?',
                            'question_sw'   => 'Katika ngazi ya C major ya mkono wa kulia, kidole gani kinapiga F (noti ya gumba kupita chini)?',
                            'options_en'    => ['Finger 2 (Index)', 'Finger 1 (Thumb)', 'Finger 3 (Middle)'],
                            'options_sw'    => ['Kidole 2 (Shahada)', 'Kidole 1 (Gumba)', 'Kidole 3 (Kati)'],
                            'correct_index' => 1,
                        ],
                        [
                            'question_en'   => 'What is the complete ascending fingering for the right-hand C major scale?',
                            'question_sw'   => 'Ni nini mfumo kamili wa vidole wa kupanda wa ngazi ya C major ya mkono wa kulia?',
                            'options_en'    => ['1 2 3 4 5 1 2 3', '1 2 3 1 2 3 4 5', '5 4 3 2 1 3 2 1'],
                            'options_sw'    => ['1 2 3 4 5 1 2 3', '1 2 3 1 2 3 4 5', '5 4 3 2 1 3 2 1'],
                            'correct_index' => 1,
                        ],
                        [
                            'question_en'   => 'Descending from C5 back to C4, which finger plays E?',
                            'question_sw'   => 'Ukishuka kutoka C5 kurudi C4, kidole gani kinapiga E?',
                            'options_en'    => ['Finger 1 (Thumb)', 'Finger 4 (Ring)', 'Finger 3 (Middle)'],
                            'options_sw'    => ['Kidole 1 (Gumba)', 'Kidole 4 (Dhahabu)', 'Kidole 3 (Kati)'],
                            'correct_index' => 2,
                        ],
                    ],
                ],
            ]
        );
    }

    private function seedLesson9(): void
    {
        $lesson = Lesson::where('order', 9)->first();
        if (!$lesson) return;

        $lesson->update(['xp_completion' => 90, 'xp_perfect' => 25]);

        // ── Section 1: Content ────────────────────────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson->id, 'display_order' => 1],
            [
                'section_type' => 'content',
                'xp_reward'    => 25,
                'data'         => [
                    'topics' => [
                        [
                            'title_en' => 'Left Hand Full Scale',
                            'title_sw' => 'Ngazi Nzima ya Mkono wa Kushoto',
                            'body_en'  => "You already know the left-hand five-finger position: pinky (5) on C3, thumb (1) on G3. Now you'll extend that to cover the full C major scale all the way to C4.\n\nThe full ascending fingering is:\n\n5 – 4 – 3 – 2 – 1 – 3 – 2 – 1\n\nThe thumb (1) plays G3 — then finger 3 crosses OVER the thumb to reach A3. This is called the finger crossover, and it shifts your hand into the second position to cover A, B, and C.",
                            'body_sw'  => "Unajua tayari nafasi ya vidole vitano vya mkono wa kushoto: kidogo (5) kwenye C3, gumba (1) kwenye G3. Sasa utaendelea ili kufunika ngazi nzima ya C major hadi C4.\n\nMfumo kamili wa kupanda ni:\n\n5 – 4 – 3 – 2 – 1 – 3 – 2 – 1\n\nGumba (1) linapiga G3 — kisha kidole 3 kinapita JUU ya gumba kufikia A3. Hii inaitwa kupita kwa kidole, na inahamisha mkono wako kwenye nafasi ya pili ili kufunika A, B, na C.",
                            'visual'   => [
                                'type'       => 'highlight_keys',
                                'keys'       => ['C', 'D', 'E', 'F', 'G', 'A', 'B', 'C5'],
                                'labels'     => ['C' => '5', 'D' => '4', 'E' => '3', 'F' => '2', 'G' => '1', 'A' => '3', 'B' => '2', 'C5' => '1'],
                                'caption_en' => 'Left hand: full C major scale fingering',
                                'caption_sw' => 'Mkono wa kushoto: vidole vya ngazi nzima ya C major',
                            ],
                        ],
                        [
                            'title_en' => 'The Finger Crossover',
                            'title_sw' => 'Kupita kwa Kidole',
                            'body_en'  => "After playing G3 with your thumb, finger 3 (middle finger) swings OVER the thumb to land on A3 while the thumb lifts. This is the left-hand equivalent of the right-hand thumb tuck.\n\nHow to practise:\n1. Play C3–G3 slowly (fingers 5–4–3–2–1)\n2. While your thumb is on G3, position finger 3 above A3\n3. As you lift your thumb, press A3 with finger 3\n4. Continue: B3 (2) – C4 (1)\n\nKeep the movement smooth — the wrist should stay steady, only the fingers move.",
                            'body_sw'  => "Baada ya kupiga G3 kwa gumba lako, kidole 3 (kidole cha kati) kinapiga JUURANI ya gumba kuweka A3 wakati gumba linainuka. Hii ni sawa na kidole gumba kupita chini kwa mkono wa kulia.\n\nJinsi ya kufanya mazoezi:\n1. Piga C3–G3 polepole (vidole 5–4–3–2–1)\n2. Gumba lako likiwa kwenye G3, weka kidole 3 juu ya A3\n3. Ukiinua gumba lako, bonyeza A3 kwa kidole 3\n4. Endelea: B3 (2) – C4 (1)\n\nShikilia harakati iwe laini — mkono uwe imara, vidole tu ndivyo vinavyohamia.",
                            'visual'   => [
                                'type'       => 'finger_map',
                                'hand'       => 'left',
                                'fingering'  => [
                                    ['finger' => 5, 'label_en' => 'C',    'label_sw' => 'C'],
                                    ['finger' => 4, 'label_en' => 'D',    'label_sw' => 'D'],
                                    ['finger' => 3, 'label_en' => 'E / A','label_sw' => 'E / A'],
                                    ['finger' => 2, 'label_en' => 'F / B','label_sw' => 'F / B'],
                                    ['finger' => 1, 'label_en' => 'G / C','label_sw' => 'G / C'],
                                ],
                                'caption_en' => 'After crossing, fingers 3–2–1 cover A–B–C',
                                'caption_sw' => 'Baada ya kupita, vidole 3–2–1 vifunika A–B–C',
                            ],
                        ],
                        [
                            'title_en' => 'Descending: Thumb Tuck',
                            'title_sw' => 'Kushuka: Gumba Kupita Chini',
                            'body_en'  => "Coming back down from C4 to C3, the pattern reverses:\n\n1 – 2 – 3 – 1 – 2 – 3 – 4 – 5\n\nAfter your thumb plays G3 (in the second group), it tucks UNDER finger 3 to land back on F3, allowing your hand to return to the starting position.\n\nFull descending: C4(1) B3(2) A3(3) G3(1) F3(2) E3(3) D3(4) C3(5)\n\nPractise slowly until both directions feel natural before increasing speed.",
                            'body_sw'  => "Kurudi chini kutoka C4 hadi C3, mfumo unabadilika:\n\n1 – 2 – 3 – 1 – 2 – 3 – 4 – 5\n\nBaada ya gumba lako kupiga G3 (katika kundi la pili), linapita CHINI ya kidole 3 kuweka F3, kuruhusu mkono wako kurudi nafasi ya kuanza.\n\nKushuka kamili: C4(1) B3(2) A3(3) G3(1) F3(2) E3(3) D3(4) C3(5)\n\nFanya mazoezi polepole hadi mwelekeo wote mbili uhisi wa kawaida kabla ya kuongeza kasi.",
                            'visual'   => [
                                'type'       => 'highlight_keys',
                                'keys'       => ['C5', 'B', 'A', 'G', 'F', 'E', 'D', 'C'],
                                'labels'     => ['C5' => '1', 'B' => '2', 'A' => '3', 'G' => '1', 'F' => '2', 'E' => '3', 'D' => '4', 'C' => '5'],
                                'caption_en' => 'Left hand descending: 1 2 3 — thumb tuck — 1 2 3 4 5',
                                'caption_sw' => 'Mkono wa kushoto kushuka: 1 2 3 — gumba chini — 1 2 3 4 5',
                            ],
                        ],
                    ],
                ],
            ]
        );

        // ── Section 2: Practice ───────────────────────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson->id, 'display_order' => 2],
            [
                'section_type' => 'practice',
                'xp_reward'    => 35,
                'data'         => [
                    'exercises' => [
                        [
                            'type'            => 'note_sequence',
                            'prompt_en'       => 'Left hand up: C D E F G A B C  (5 4 3 2 1 3 2 1)',
                            'prompt_sw'       => 'Mkono wa kushoto juu: C D E F G A B C  (5 4 3 2 1 3 2 1)',
                            'target_notes'    => ['C3','D3','E3','F3','G3','A3','B3','C4'],
                            'finger_sequence' => [5,4,3,2,1,3,2,1],
                            'success_count'   => 2,
                            'xp'              => 18,
                        ],
                        [
                            'type'            => 'note_sequence',
                            'prompt_en'       => 'Left hand down: C B A G F E D C  (1 2 3 1 2 3 4 5)',
                            'prompt_sw'       => 'Mkono wa kushoto chini: C B A G F E D C  (1 2 3 1 2 3 4 5)',
                            'target_notes'    => ['C4','B3','A3','G3','F3','E3','D3','C3'],
                            'finger_sequence' => [1,2,3,1,2,3,4,5],
                            'success_count'   => 2,
                            'xp'              => 17,
                        ],
                    ],
                ],
            ]
        );

        // ── Section 3: Quiz ───────────────────────────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson->id, 'display_order' => 3],
            [
                'section_type' => 'quiz',
                'xp_reward'    => 30,
                'data'         => [
                    'passing_pct' => 67,
                    'questions'   => [
                        [
                            'question_en'   => 'In the left-hand C major scale, which finger plays G3 (before the crossing)?',
                            'question_sw'   => 'Katika ngazi ya C major ya mkono wa kushoto, kidole gani kinapiga G3 (kabla ya kupita)?',
                            'options_en'    => ['Finger 5 (Pinky)', 'Finger 3 (Middle)', 'Finger 1 (Thumb)'],
                            'options_sw'    => ['Kidole 5 (Kidogo)', 'Kidole 3 (Kati)', 'Kidole 1 (Gumba)'],
                            'correct_index' => 2,
                        ],
                        [
                            'question_en'   => 'After the crossing, which finger plays A3?',
                            'question_sw'   => 'Baada ya kupita, kidole gani kinapiga A3?',
                            'options_en'    => ['Finger 1', 'Finger 2', 'Finger 3'],
                            'options_sw'    => ['Kidole 1', 'Kidole 2', 'Kidole 3'],
                            'correct_index' => 2,
                        ],
                        [
                            'question_en'   => 'What is the complete ascending fingering for the left-hand C major scale?',
                            'question_sw'   => 'Ni nini mfumo kamili wa vidole wa kupanda wa ngazi ya C major ya mkono wa kushoto?',
                            'options_en'    => ['5 4 3 2 1 2 3 4', '1 2 3 1 2 3 4 5', '5 4 3 2 1 3 2 1'],
                            'options_sw'    => ['5 4 3 2 1 2 3 4', '1 2 3 1 2 3 4 5', '5 4 3 2 1 3 2 1'],
                            'correct_index' => 2,
                        ],
                    ],
                ],
            ]
        );
    }

    private function seedLesson7(): void
    {
        $lesson7 = Lesson::where('order', 7)->first();
        if (!$lesson7) return;

        $lesson7->update(['xp_completion' => 80, 'xp_perfect' => 20]);

        // ── Section 1: Content ────────────────────────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson7->id, 'display_order' => 1],
            [
                'section_type' => 'content',
                'xp_reward'    => 20,
                'data'         => [
                    'topics' => [
                        [
                            'title_en' => 'Left Hand Finger Numbering',
                            'title_sw' => 'Nambari za Vidole vya Mkono wa Kushoto',
                            'body_en'  => "Both hands share the same finger numbering:\n\n• 1 — Thumb\n• 2 — Index finger\n• 3 — Middle finger\n• 4 — Ring finger\n• 5 — Pinky\n\nFor the LEFT hand, the thumb (1) sits closest to the centre of the keyboard — on the higher notes. The pinky (5) reaches to the lower notes on the left.\n\nThis is the mirror image of the right hand, but the numbers stay the same.",
                            'body_sw'  => "Mikono yote miwili inatumia nambari sawa za vidole:\n\n• 1 — Gumba\n• 2 — Shahada\n• 3 — Kati\n• 4 — Dhahabu\n• 5 — Kidogo\n\nKwa mkono wa KUSHOTO, gumba (1) liko karibu na katikati ya kibodi — kwenye noti za juu. Kidogo (5) kinafikia noti za chini upande wa kushoto.\n\nHii ni picha ya kioo ya mkono wa kulia, lakini nambari zinabaki sawa.",
                            'visual'   => [
                                'type'       => 'finger_map',
                                'hand'       => 'left',
                                'fingering'  => [
                                    ['finger' => 5, 'label_en' => 'Pinky',  'label_sw' => 'Kidogo'],
                                    ['finger' => 4, 'label_en' => 'Ring',   'label_sw' => 'Dhahabu'],
                                    ['finger' => 3, 'label_en' => 'Middle', 'label_sw' => 'Kati'],
                                    ['finger' => 2, 'label_en' => 'Index',  'label_sw' => 'Shahada'],
                                    ['finger' => 1, 'label_en' => 'Thumb',  'label_sw' => 'Gumba'],
                                ],
                                'caption_en' => 'Left hand: pinky on the left, thumb on the right',
                                'caption_sw' => 'Mkono wa kushoto: kidogo kushoto, gumba kulia',
                            ],
                        ],
                        [
                            'title_en' => 'Left Hand Five-Finger Position',
                            'title_sw' => 'Nafasi ya Vidole Vitano vya Mkono wa Kushoto',
                            'body_en'  => "In the left-hand five-finger position, each finger rests on one key:\n\n  5 → C   4 → D   3 → E   2 → F   1 → G\n\nYour pinky (5) starts on C3, and your thumb (1) reaches G3.\n\nThis is the octave just below middle C — one step to the left of where your right hand sits.\n\nKeep your wrist level and fingers gently curved, just like the right hand.",
                            'body_sw'  => "Katika nafasi ya vidole vitano vya mkono wa kushoto, kila kidole kinakaa juu ya kitufe kimoja:\n\n  5 → C   4 → D   3 → E   2 → F   1 → G\n\nKidogo chako (5) kinaanza kwenye C3, na gumba lako (1) linafikia G3.\n\nHii ni oktavu moja chini ya C ya Kati — hatua moja kushoto ya mahali ambapo mkono wako wa kulia unakaa.\n\nShikilia mkono wako sawa na vidole vikilainishwa, kama mkono wa kulia.",
                            'visual'   => [
                                'type'       => 'finger_map',
                                'hand'       => 'left',
                                'fingering'  => [
                                    ['finger' => 5, 'label_en' => 'C', 'label_sw' => 'C'],
                                    ['finger' => 4, 'label_en' => 'D', 'label_sw' => 'D'],
                                    ['finger' => 3, 'label_en' => 'E', 'label_sw' => 'E'],
                                    ['finger' => 2, 'label_en' => 'F', 'label_sw' => 'F'],
                                    ['finger' => 1, 'label_en' => 'G', 'label_sw' => 'G'],
                                ],
                                'caption_en' => 'Left hand: pinky on C, thumb on G',
                                'caption_sw' => 'Mkono wa kushoto: kidogo kwenye C, gumba kwenye G',
                            ],
                        ],
                        [
                            'title_en' => 'Playing the Left-Hand Scale',
                            'title_sw' => 'Kupiga Ngazi ya Mkono wa Kushoto',
                            'body_en'  => "To play a scale with your left hand, you move from pinky to thumb going up:\n\n5 (C) → 4 (D) → 3 (E) → 2 (F) → 1 (G)\n\nAnd from thumb to pinky going back down:\n\n1 (G) → 2 (F) → 3 (E) → 4 (D) → 5 (C)\n\nNotice that going UP the scale means using lower finger numbers — the opposite of the right hand.\n\nPractise slowly until each finger feels natural on its key.",
                            'body_sw'  => "Kupiga ngazi kwa mkono wako wa kushoto, unahamia kutoka kidogo hadi gumba ukipanda juu:\n\n5 (C) → 4 (D) → 3 (E) → 2 (F) → 1 (G)\n\nNa kutoka gumba hadi kidogo ukishuka chini:\n\n1 (G) → 2 (F) → 3 (E) → 4 (D) → 5 (C)\n\nAngalia kwamba kupanda ngazi kunamaanisha kutumia nambari ndogo za vidole — kinyume na mkono wa kulia.\n\nFanya mazoezi pole pole hadi kila kidole kihisi kuwa cha kawaida kwenye kitufe chake.",
                            'visual'   => [
                                'type'       => 'highlight_keys',
                                'keys'       => ['C', 'D', 'E', 'F', 'G'],
                                'labels'     => ['C' => '5', 'D' => '4', 'E' => '3', 'F' => '2', 'G' => '1'],
                                'caption_en' => 'Left hand span: C to G (finger 5 to finger 1)',
                                'caption_sw' => 'Upeo wa mkono wa kushoto: C hadi G (kidole 5 hadi kidole 1)',
                            ],
                        ],
                    ],
                ],
            ]
        );

        // ── Section 2: Practice ───────────────────────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson7->id, 'display_order' => 2],
            [
                'section_type' => 'practice',
                'xp_reward'    => 30,
                'data'         => [
                    'exercises' => [
                        [
                            'type'            => 'note_sequence',
                            'prompt_en'       => 'Left hand up: C D E F G (fingers 5→1)',
                            'prompt_sw'       => 'Mkono wa kushoto juu: C D E F G (vidole 5→1)',
                            'target_notes'    => ['C3', 'D3', 'E3', 'F3', 'G3'],
                            'finger_sequence' => [5, 4, 3, 2, 1],
                            'success_count'   => 2,
                            'xp'              => 15,
                        ],
                        [
                            'type'            => 'note_sequence',
                            'prompt_en'       => 'Left hand down: G F E D C (fingers 1→5)',
                            'prompt_sw'       => 'Mkono wa kushoto chini: G F E D C (vidole 1→5)',
                            'target_notes'    => ['G3', 'F3', 'E3', 'D3', 'C3'],
                            'finger_sequence' => [1, 2, 3, 4, 5],
                            'success_count'   => 2,
                            'xp'              => 15,
                        ],
                    ],
                ],
            ]
        );

        // ── Section 3: Quiz ───────────────────────────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson7->id, 'display_order' => 3],
            [
                'section_type' => 'quiz',
                'xp_reward'    => 30,
                'data'         => [
                    'passing_pct' => 67,
                    'questions'   => [
                        [
                            'question_en'   => 'In the left-hand position, which finger plays the note C?',
                            'question_sw'   => 'Katika nafasi ya mkono wa kushoto, kidole gani kinapiga noti C?',
                            'options_en'    => ['Finger 1 (Thumb)', 'Finger 3 (Middle)', 'Finger 5 (Pinky)'],
                            'options_sw'    => ['Kidole 1 (Gumba)', 'Kidole 3 (Kati)', 'Kidole 5 (Kidogo)'],
                            'correct_index' => 2,
                        ],
                        [
                            'question_en'   => 'In the left-hand position, which note does the thumb (finger 1) play?',
                            'question_sw'   => 'Katika nafasi ya mkono wa kushoto, gumba (kidole 1) linapiga noti gani?',
                            'options_en'    => ['C', 'E', 'G'],
                            'options_sw'    => ['C', 'E', 'G'],
                            'correct_index' => 2,
                        ],
                        [
                            'question_en'   => 'Playing up the scale with your left hand (C to G), which finger number do you use first?',
                            'question_sw'   => 'Ukipiga ngazi juu kwa mkono wako wa kushoto (C hadi G), unatumia nambari gani ya kidole kwanza?',
                            'options_en'    => ['Finger 1', 'Finger 3', 'Finger 5'],
                            'options_sw'    => ['Kidole 1', 'Kidole 3', 'Kidole 5'],
                            'correct_index' => 2,
                        ],
                    ],
                ],
            ]
        );
    }

    private function seedLesson6(): void
    {
        $lesson6 = Lesson::where('order', 6)->first();
        if (!$lesson6) return;

        $lesson6->update(['xp_completion' => 80, 'xp_perfect' => 20]);

        // ── Section 1: Content ────────────────────────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson6->id, 'display_order' => 1],
            [
                'section_type' => 'content',
                'xp_reward'    => 20,
                'data'         => [
                    'topics' => [
                        [
                            'title_en' => 'Finger Numbering',
                            'title_sw' => 'Nambari za Vidole',
                            'body_en'  => "Every finger has a number. Starting from your thumb, they are numbered 1 to 5:\n\n• 1 — Thumb (the widest, shortest finger)\n• 2 — Index finger\n• 3 — Middle finger (the longest)\n• 4 — Ring finger\n• 5 — Pinky (the smallest)\n\nBoth your left and right hands use the same numbering system. This system is used in all piano music worldwide.",
                            'body_sw'  => "Kila kidole kina nambari. Ukianza na kidole gumba, vinapigiwa namba 1 hadi 5:\n\n• 1 — Gumba (kidole kipana na kifupi)\n• 2 — Shahada\n• 3 — Kati (kidole kirefu)\n• 4 — Dhahabu\n• 5 — Kidogo (kidole kidogo)\n\nMikono yote miwili ya kushoto na ya kulia inatumia mpangilio huu huo. Mfumo huu unatumika katika muziki wote wa piano duniani kote.",
                            'visual'   => [
                                'type'       => 'finger_map',
                                'hand'       => 'right',
                                'fingering'  => [
                                    ['finger' => 1, 'label_en' => 'Thumb',  'label_sw' => 'Gumba'],
                                    ['finger' => 2, 'label_en' => 'Index',  'label_sw' => 'Shahada'],
                                    ['finger' => 3, 'label_en' => 'Middle', 'label_sw' => 'Kati'],
                                    ['finger' => 4, 'label_en' => 'Ring',   'label_sw' => 'Dhahabu'],
                                    ['finger' => 5, 'label_en' => 'Pinky',  'label_sw' => 'Kidogo'],
                                ],
                                'caption_en' => 'Fingers 1–5, from thumb to pinky',
                                'caption_sw' => 'Vidole 1–5, kutoka gumba hadi kidogo',
                            ],
                        ],
                        [
                            'title_en' => 'Five-Finger Position',
                            'title_sw' => 'Nafasi ya Vidole Vitano',
                            'body_en'  => "In the five-finger position, each finger of your right hand rests on one key:\n\n  1 → C   2 → D   3 → E   4 → F   5 → G\n\nYour thumb (1) starts on C4, and your pinky (5) reaches G4.\n\nKeep your fingers gently curved — imagine you are holding a small ball. Your wrist should be level, not drooping or raised.",
                            'body_sw'  => "Katika nafasi ya vidole vitano, kila kidole cha mkono wako wa kulia kinakaa juu ya kitufe kimoja:\n\n  1 → C   2 → D   3 → E   4 → F   5 → G\n\nKidole gumba chako (1) kinaanza kwenye C4, na kidole kidogo chako (5) kinafikia G4.\n\nShikilia vidole vyako vikilainishwa — fikiri unashika mpira mdogo. Mkono wako uwe sawa, usishuke wala kupaa.",
                            'visual'   => [
                                'type'       => 'finger_map',
                                'hand'       => 'right',
                                'fingering'  => [
                                    ['finger' => 1, 'label_en' => 'C', 'label_sw' => 'C'],
                                    ['finger' => 2, 'label_en' => 'D', 'label_sw' => 'D'],
                                    ['finger' => 3, 'label_en' => 'E', 'label_sw' => 'E'],
                                    ['finger' => 4, 'label_en' => 'F', 'label_sw' => 'F'],
                                    ['finger' => 5, 'label_en' => 'G', 'label_sw' => 'G'],
                                ],
                                'caption_en' => 'Right hand: thumb on C, pinky on G',
                                'caption_sw' => 'Mkono wa kulia: gumba kwenye C, kidogo kwenye G',
                            ],
                        ],
                        [
                            'title_en' => 'Moving Between Notes',
                            'title_sw' => 'Kuhamia Kati ya Noti',
                            'body_en'  => "Once your fingers are in position, each one moves independently.\n\nTry this:\n1. Rest all five fingers on C–G\n2. Lift finger 1 (thumb) and tap C\n3. Then lift finger 2 and tap D\n4. Continue to finger 5 on G\n5. Then reverse: 5 → 4 → 3 → 2 → 1\n\nKeep the fingers that are not playing as close to the keys as possible — this builds speed and accuracy.",
                            'body_sw'  => "Mara vidole vyako vikiwa katika nafasi, kila kimoja kinahamia kwa uhuru wake.\n\nJaribu hivi:\n1. Weka vidole vyote vitano kwenye C–G\n2. Inua kidole cha 1 (gumba) na gusa C\n3. Kisha inua kidole cha 2 na gusa D\n4. Endelea hadi kidole cha 5 kwenye G\n5. Kisha rudi nyuma: 5 → 4 → 3 → 2 → 1\n\nShikilia vidole visivyopiga karibu iwezekanavyo na vitufe — hii hujenga kasi na usahihi.",
                            'visual'   => [
                                'type'       => 'highlight_keys',
                                'keys'       => ['C', 'D', 'E', 'F', 'G'],
                                'labels'     => ['C' => '1', 'D' => '2', 'E' => '3', 'F' => '4', 'G' => '5'],
                                'caption_en' => 'Five-finger span: C to G',
                                'caption_sw' => 'Upeo wa vidole vitano: C hadi G',
                            ],
                        ],
                    ],
                ],
            ]
        );

        // ── Section 2: Practice ───────────────────────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson6->id, 'display_order' => 2],
            [
                'section_type' => 'practice',
                'xp_reward'    => 30,
                'data'         => [
                    'exercises' => [
                        [
                            'type'            => 'note_sequence',
                            'prompt_en'       => 'Play the scale up: C D E F G',
                            'prompt_sw'       => 'Piga ngazi juu: C D E F G',
                            'target_notes'    => ['C4', 'D4', 'E4', 'F4', 'G4'],
                            'finger_sequence' => [1, 2, 3, 4, 5],
                            'success_count'   => 2,
                            'xp'              => 15,
                        ],
                        [
                            'type'            => 'note_sequence',
                            'prompt_en'       => 'Now play it down: G F E D C',
                            'prompt_sw'       => 'Sasa piga ngazi chini: G F E D C',
                            'target_notes'    => ['G4', 'F4', 'E4', 'D4', 'C4'],
                            'finger_sequence' => [5, 4, 3, 2, 1],
                            'success_count'   => 2,
                            'xp'              => 15,
                        ],
                    ],
                ],
            ]
        );

        // ── Section 3: Quiz ───────────────────────────────────────────────────
        LessonSection::updateOrCreate(
            ['lesson_id' => $lesson6->id, 'display_order' => 3],
            [
                'section_type' => 'quiz',
                'xp_reward'    => 30,
                'data'         => [
                    'passing_pct' => 67,
                    'questions'   => [
                        [
                            'question_en'   => 'Which finger number is the thumb?',
                            'question_sw'   => 'Kidole gumba kina nambari gani?',
                            'options_en'    => ['1', '3', '5'],
                            'options_sw'    => ['1', '3', '5'],
                            'correct_index' => 0,
                        ],
                        [
                            'question_en'   => 'In 5-finger position, which finger plays the note E?',
                            'question_sw'   => 'Katika nafasi ya vidole vitano, kidole gani kinapiga noti E?',
                            'options_en'    => ['Finger 2 (Index)', 'Finger 3 (Middle)', 'Finger 4 (Ring)'],
                            'options_sw'    => ['Kidole 2 (Shahada)', 'Kidole 3 (Kati)', 'Kidole 4 (Dhahabu)'],
                            'correct_index' => 1,
                        ],
                        [
                            'question_en'   => 'In 5-finger position, which note does finger 5 (pinky) play?',
                            'question_sw'   => 'Katika nafasi ya vidole vitano, kidole 5 (kidogo) kinapiga noti gani?',
                            'options_en'    => ['E', 'F', 'G'],
                            'options_sw'    => ['E', 'F', 'G'],
                            'correct_index' => 2,
                        ],
                    ],
                ],
            ]
        );
    }
}
