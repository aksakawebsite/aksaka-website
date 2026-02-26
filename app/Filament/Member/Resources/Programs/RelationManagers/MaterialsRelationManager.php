<?php

namespace App\Filament\Member\Resources\Programs\RelationManagers;

use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MaterialsRelationManager extends RelationManager
{
    protected static string $relationship = 'materials';

    protected static ?string $title = 'Materi Pembelajaran';

    public function isReadOnly(): bool
    {
        return true;
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')
                    ->label('#')
                    ->sortable()
                    ->width('40px'),
                TextColumn::make('title')
                    ->label('Judul Materi')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'video' => 'info',
                        'document' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
            ])
            ->defaultSort('order')
            ->recordActions([
                Action::make('mulai_belajar')
                    ->label('Mulai Belajar')
                    ->url(fn ($record) => \App\Filament\Member\Resources\Materials\MaterialResource::getUrl('view', ['record' => $record]))
                    ->button()
                    ->color('primary'),
            ])
            ->headerActions([]);
    }
}
