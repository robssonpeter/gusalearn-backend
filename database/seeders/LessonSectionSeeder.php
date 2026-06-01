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
