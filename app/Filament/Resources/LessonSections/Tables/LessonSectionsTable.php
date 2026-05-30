<?php

namespace App\Filament\Resources\LessonSections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LessonSectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lesson.title')
                    ->label('Lesson')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('display_order')
                    ->label('#')
                    ->sortable()
                    ->width(40),
                TextColumn::make('section_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'content'        => 'info',
                        'quiz'           => 'warning',
                        'music_activity' => 'success',
                        default          => 'gray',
                    }),
                TextColumn::make('xp_reward')
                    ->label('XP')
                    ->suffix(' xp')
                    ->numeric(),
            ])
            ->defaultSort('display_order')
            ->filters([
                SelectFilter::make('lesson_id')
                    ->relationship('lesson', 'title')
                    ->label('Lesson'),
                SelectFilter::make('section_type')
                    ->options([
                        'content'        => 'Content',
                        'quiz'           => 'Quiz',
                        'music_activity' => 'Music Activity',
                    ]),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
