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
            TextInput::make('title')
                ->required()
                ->maxLength(80)
                ->columnSpanFull(),
            TextInput::make('subtitle')
                ->required()
                ->maxLength(120)
                ->helperText('One-line goal statement shown to students')
                ->columnSpanFull(),
            Toggle::make('is_published')
                ->helperText('Unpublished paths are hidden from students'),
        ]);
    }
}
