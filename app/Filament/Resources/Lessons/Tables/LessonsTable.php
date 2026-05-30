<?php

namespace App\Filament\Resources\Lessons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class LessonsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')
                    ->label('#')
                    ->sortable()
                    ->width(44),
                TextColumn::make('title')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('module.module_code')
                    ->label('Module')
                    ->badge()
                    ->color('info')
                    ->searchable(),
                TextColumn::make('module.learningPath.title')
                    ->label('Path')
                    ->color('gray')
                    ->limit(28),
                TextColumn::make('sections_count')
                    ->label('Sections')
                    ->counts('sections')
                    ->badge()
                    ->color('warning'),
                TextColumn::make('xp_completion')
                    ->label('XP')
                    ->suffix(' xp'),
                IconColumn::make('is_free')
                    ->label('Free')
                    ->boolean(),
                IconColumn::make('is_published')
                    ->label('Live')
                    ->boolean(),
            ])
            ->defaultSort('order')
            ->filters([
                SelectFilter::make('module_id')
                    ->relationship('module', 'title')
                    ->label('Module'),
                TernaryFilter::make('is_published')->label('Published'),
                TernaryFilter::make('is_free')->label('Free'),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
