<?php

namespace App\Filament\Resources\Modules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ModulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('module_code')
                    ->label('Code')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('learningPath.title')
                    ->label('Path')
                    ->searchable()
                    ->sortable()
                    ->color('gray'),
                TextColumn::make('lessons_count')
                    ->label('Lessons')
                    ->counts('lessons')
                    ->badge()
                    ->color('success'),
                IconColumn::make('is_published')
                    ->label('Live')
                    ->boolean(),
            ])
            ->defaultSort('module_code')
            ->filters([
                SelectFilter::make('learning_path_id')
                    ->relationship('learningPath', 'title')
                    ->label('Path'),
                TernaryFilter::make('is_published')->label('Published'),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
