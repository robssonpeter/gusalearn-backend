<?php

namespace App\Filament\Resources\LearningPaths\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LearningPathForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(3)->schema([
                TextInput::make('order')
                    ->required()
                    ->integer()
                    ->minValue(1),
                TextInput::make('icon')
                    ->required()
                    ->placeholder('🎹')
                    ->helperText('Paste an emoji'),
                ColorPicker::make('color_hex')
                    ->required(),
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
                TextInput::make('subtitle')
                    ->label('Subtitle / Goal (English)')
                    ->required()
                    ->maxLength(120),
                TextInput::make('subtitle_sw')
                    ->label('Subtitle / Goal (Swahili)')
                    ->maxLength(120),
            ]),
            Toggle::make('is_published')
                ->helperText('Unpublished paths are hidden from students'),
        ]);
    }
}
