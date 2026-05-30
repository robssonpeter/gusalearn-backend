<?php

namespace App\Filament\Resources\Modules\Schemas;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ModuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('learning_path_id')
                ->relationship('learningPath', 'title')
                ->searchable()
                ->required()
                ->columnSpanFull(),
            Grid::make(3)->schema([
                TextInput::make('order')
                    ->required()
                    ->integer()
                    ->minValue(1),
                TextInput::make('module_code')
                    ->required()
                    ->placeholder('PF-M1')
                    ->helperText('e.g. PF-M2, WP-M3'),
                Toggle::make('is_published')
                    ->label('Published')
                    ->inline(false),
            ]),
            TextInput::make('title')
                ->required()
                ->maxLength(80)
                ->columnSpanFull(),
            Textarea::make('description')
                ->required()
                ->maxLength(200)
                ->rows(2)
                ->columnSpanFull(),
        ]);
    }
}
