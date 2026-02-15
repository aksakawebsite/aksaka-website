<?php

namespace App\Filament\Resources\Quizzes\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class QuizzesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('program.title')
                    ->label('Program')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                TextColumn::make('title')
                    ->label('Judul Quiz')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->wrap(),
                TextColumn::make('gform_url')
                    ->label('Google Form')
                    ->limit(30)
                    ->url(fn ($record) => $record->gform_url)
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('success'),
                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable()
                    ->badge(),
            ])
            ->filters([
                SelectFilter::make('program_id')
                    ->relationship('program', 'title')
                    ->label('Program'),
            ])
            ->defaultSort('order', 'asc');
    }
}
