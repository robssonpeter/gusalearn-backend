<?php

namespace App\Filament\Resources\LessonSections\Schemas;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class LessonSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            // ── Header ──────────────────────────────────────────────────
            Select::make('lesson_id')
                ->relationship('lesson', 'title')
                ->searchable()
                ->required()
                ->columnSpanFull(),

            Grid::make(3)->schema([
                TextInput::make('display_order')
                    ->label('Order')
                    ->required()
                    ->integer()
                    ->minValue(1)
                    ->default(1),
                Select::make('section_type')
                    ->label('Type')
                    ->options([
                        'content'        => '📖 Content (Topics)',
                        'quiz'           => '📝 Quiz',
                        'practice'       => '🎹 Practice',
                        'music_activity' => '🎵 Music Activity',
                    ])
                    ->required()
                    ->live(),
                TextInput::make('xp_reward')
                    ->label('XP Reward')
                    ->required()
                    ->integer()
                    ->default(20),
            ]),

            // ── CONTENT SECTION ──────────────────────────────────────────
            Section::make('Topics')
                ->description('Each topic is one swipeable screen the student reads before practising.')
                ->visible(fn (Get $get) => $get('section_type') === 'content')
                ->schema([
                    Repeater::make('topics')
                        ->label('')
                        ->schema([
                            Grid::make(2)->schema([
                                TextInput::make('title_en')
                                    ->label('Title (English)')
                                    ->required(),
                                TextInput::make('title_sw')
                                    ->label('Title (Swahili)')
                                    ->required(),
                            ]),
                            Grid::make(2)->schema([
                                Textarea::make('body_en')
                                    ->label('Body (English)')
                                    ->rows(6)
                                    ->required(),
                                Textarea::make('body_sw')
                                    ->label('Body (Swahili)')
                                    ->rows(6)
                                    ->required(),
                            ]),

                            // Visual sub-form
                            Section::make('Visual')
                                ->collapsed()
                                ->description('Optional keyboard diagram shown above the topic text.')
                                ->schema([
                                    Select::make('visual_type')
                                        ->label('Type')
                                        ->options([
                                            ''               => 'None',
                                            'keyboard_pattern' => 'Keyboard Pattern (2-3 groups)',
                                            'highlight_keys'   => 'Highlight Keys',
                                        ])
                                        ->default('')
                                        ->live(),

                                    TagsInput::make('visual_keys')
                                        ->label('Keys to highlight')
                                        ->placeholder('C, E, G')
                                        ->helperText('Note names: C D E F G A B (add # for sharps)')
                                        ->visible(fn (Get $get) => $get('visual_type') === 'highlight_keys'),

                                    KeyValue::make('visual_labels')
                                        ->label('Key labels')
                                        ->keyLabel('Note')
                                        ->valueLabel('Label shown on key')
                                        ->helperText('e.g.  C → Middle C')
                                        ->visible(fn (Get $get) => $get('visual_type') === 'highlight_keys'),

                                    Grid::make(2)->schema([
                                        TextInput::make('visual_caption_en')
                                            ->label('Caption (English)'),
                                        TextInput::make('visual_caption_sw')
                                            ->label('Caption (Swahili)'),
                                    ])->visible(fn (Get $get) => $get('visual_type') === 'highlight_keys'),
                                ]),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['title_en'] ?? null)
                        ->collapsible()
                        ->cloneable()
                        ->reorderableWithButtons()
                        ->addActionLabel('Add Topic'),
                ]),

            // ── QUIZ SECTION ─────────────────────────────────────────────
            Section::make('Quiz')
                ->description('Multiple-choice questions the student answers after practising.')
                ->visible(fn (Get $get) => $get('section_type') === 'quiz')
                ->schema([
                    TextInput::make('passing_pct')
                        ->label('Passing score (%)')
                        ->required()
                        ->integer()
                        ->minValue(50)
                        ->maxValue(100)
                        ->default(67)
                        ->suffix('%'),

                    Repeater::make('questions')
                        ->label('')
                        ->schema([
                            Grid::make(2)->schema([
                                Textarea::make('question_en')
                                    ->label('Question (English)')
                                    ->rows(2)
                                    ->required(),
                                Textarea::make('question_sw')
                                    ->label('Question (Swahili)')
                                    ->rows(2)
                                    ->required(),
                            ]),

                            Grid::make(2)->schema([
                                Repeater::make('options_en')
                                    ->label('Options (English)')
                                    ->simple(TextInput::make('value')->required())
                                    ->minItems(2)
                                    ->maxItems(4)
                                    ->reorderableWithButtons()
                                    ->addActionLabel('Add option'),
                                Repeater::make('options_sw')
                                    ->label('Options (Swahili)')
                                    ->simple(TextInput::make('value')->required())
                                    ->minItems(2)
                                    ->maxItems(4)
                                    ->reorderableWithButtons()
                                    ->addActionLabel('Add option'),
                            ]),

                            TextInput::make('correct_index')
                                ->label('Correct answer (0-indexed)')
                                ->helperText('0 = first option, 1 = second, 2 = third…')
                                ->required()
                                ->integer()
                                ->minValue(0)
                                ->maxValue(3),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['question_en'] ?? null)
                        ->collapsible()
                        ->reorderableWithButtons()
                        ->addActionLabel('Add Question'),
                ]),

            // ── PRACTICE SECTION ─────────────────────────────────────────
            Section::make('Practice')
                ->description('Exercises the student completes on the keyboard.')
                ->visible(fn (Get $get) => $get('section_type') === 'practice')
                ->schema([
                    Repeater::make('exercises')
                        ->label('')
                        ->schema([
                            Grid::make(2)->schema([
                                Select::make('type')
                                    ->label('Exercise Type')
                                    ->options([
                                        'single_note'    => '🎵 Single Note',
                                        'note_sequence'  => '🎼 Note Sequence',
                                        'speed_challenge' => '⚡ Speed Challenge',
                                        'rhythm_tap'     => '🥁 Rhythm Tap',
                                    ])
                                    ->required()
                                    ->default('single_note'),
                                TagsInput::make('target_notes')
                                    ->label('Target Notes')
                                    ->placeholder('C4, D4, E4')
                                    ->helperText('Note names with optional octave: C, D4, F#5'),
                            ]),
                            Grid::make(2)->schema([
                                TextInput::make('prompt_en')
                                    ->label('Prompt (English)')
                                    ->required()
                                    ->placeholder('Find and tap the C note'),
                                TextInput::make('prompt_sw')
                                    ->label('Prompt (Swahili)')
                                    ->required()
                                    ->placeholder('Tafuta na gusa kitufe cha C'),
                            ]),
                            Grid::make(2)->schema([
                                TextInput::make('success_count')
                                    ->label('Success Count')
                                    ->integer()
                                    ->minValue(1)
                                    ->default(8)
                                    ->helperText('How many correct hits to pass'),
                                TextInput::make('xp')
                                    ->label('XP Reward')
                                    ->integer()
                                    ->minValue(0)
                                    ->default(10),
                            ]),
                        ])
                        ->itemLabel(fn (array $state): ?string => $state['prompt_en'] ?? null)
                        ->collapsible()
                        ->reorderableWithButtons()
                        ->addActionLabel('Add Exercise'),
                ]),

            // ── MUSIC ACTIVITY SECTION ───────────────────────────────────
            Section::make('Music Activity')
                ->description('Free-play section where the student experiments on the keyboard.')
                ->visible(fn (Get $get) => $get('section_type') === 'music_activity')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('act_title_en')
                            ->label('Title (English)')
                            ->required()
                            ->placeholder('My First Piano Sound'),
                        TextInput::make('act_title_sw')
                            ->label('Title (Swahili)')
                            ->required()
                            ->placeholder('Sauti Yangu ya Kwanza'),
                    ]),
                    Grid::make(2)->schema([
                        Textarea::make('act_instructions_en')
                            ->label('Instructions (English)')
                            ->rows(5)
                            ->required(),
                        Textarea::make('act_instructions_sw')
                            ->label('Instructions (Swahili)')
                            ->rows(5)
                            ->required(),
                    ]),
                    TextInput::make('act_target_note')
                        ->label('Target note (optional)')
                        ->placeholder('C')
                        ->helperText('If set, this note is pre-highlighted on the keyboard'),
                ]),

        ]);
    }
}
