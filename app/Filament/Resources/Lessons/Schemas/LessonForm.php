<?php

namespace App\Filament\Resources\Lessons\Schemas;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LessonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('module_id')
                ->relationship('module', 'title')
                ->searchable()
                ->required()
                ->columnSpanFull(),

            Grid::make(3)->schema([
                TextInput::make('order')
                    ->required()
                    ->integer()
                    ->minValue(1),
                Select::make('mode_support')
                    ->options(['both' => 'Both modes', 'screen_only' => 'Screen only'])
                    ->default('both')
                    ->required(),
                Toggle::make('is_published')->label('Published')->inline(false),
            ]),

            Grid::make(2)->schema([
                TextInput::make('title')
                    ->label('Title (English)')
                    ->required()
                    ->maxLength(80),
                TextInput::make('title_sw')
                    ->label('Title (Swahili)')
                    ->maxLength(80),
            ]),

            Grid::make(2)->schema([
                Textarea::make('description')
                    ->label('Description (English)')
                    ->required()
                    ->rows(2),
                Textarea::make('description_sw')
                    ->label('Description (Swahili)')
                    ->rows(2),
            ]),

            TagsInput::make('note_sequence')
                ->required()
                ->helperText('Notes the student must play in order, e.g. C4, D4, E4')
                ->placeholder('Add a note (C4, D4…)')
                ->columnSpanFull(),

            Grid::make(3)->schema([
                TextInput::make('tempo_target')
                    ->label('Tempo (BPM)')
                    ->integer()
                    ->placeholder('60'),
                TextInput::make('xp_completion')
                    ->label('XP on complete')
                    ->required()
                    ->integer()
                    ->default(50),
                TextInput::make('xp_perfect')
                    ->label('XP bonus (perfect)')
                    ->required()
                    ->integer()
                    ->default(20),
            ]),

            Toggle::make('is_free')
                ->label('Free lesson (no account required)')
                ->helperText('Only the first 1–2 lessons should be free'),
        ]);
    }
}
