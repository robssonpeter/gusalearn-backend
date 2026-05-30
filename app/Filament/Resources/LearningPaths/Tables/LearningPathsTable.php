<?php

namespace App\Filament\Resources\LearningPaths\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class LearningPathsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')
                    ->label('#')
                    ->sortable()
                    ->width(40),
                TextColumn::make('icon')
                    ->label('')
                    ->width(36),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('subtitle')
                    ->searchable()
                    ->color('gray')
                    ->limit(50),
                ColorColumn::make('color_hex')
                    ->label('Color'),
                TextColumn::make('modules_count')
                    ->label('Modules')
                    ->counts('modules')
                    ->badge()
                    ->color('info'),
                IconColumn::make('is_published')
                    ->label('Live')
                    ->boolean(),
            ])
            ->defaultSort('order')
            ->filters([
                TernaryFilter::make('is_published')->label('Published'),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
