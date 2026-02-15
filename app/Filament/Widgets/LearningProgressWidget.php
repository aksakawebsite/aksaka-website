<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LearningProgressWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Monitoring Progres Belajar Member')
            ->query(
                User::query()
                    ->where('role', 'user')
                    ->withCount([
                        'materialProgress',
                        'materialProgress as completed_materials' => function ($query) {
                            $query->where('status', 'completed');
                        },
                    ])
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Member')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('material_progress_count')
                    ->label('Total Materi')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('completed_materials')
                    ->label('Selesai')
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('progress_percentage')
                    ->label('Progress')
                    ->getStateUsing(function ($record) {
                        if ($record->material_progress_count == 0) {
                            return '0%';
                        }
                        $percentage = round(($record->completed_materials / $record->material_progress_count) * 100);

                        return $percentage.'%';
                    })
                    ->badge()
                    ->color(fn ($record): string => match (true) {
                        $record->material_progress_count == 0 => 'gray',
                        ($record->completed_materials / max($record->material_progress_count, 1)) >= 0.7 => 'success',
                        ($record->completed_materials / max($record->material_progress_count, 1)) >= 0.4 => 'warning',
                        default => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('progress')
                    ->label('Progress Status')
                    ->options([
                        'high' => 'Progress Tinggi (≥70%)',
                        'medium' => 'Progress Sedang (40-69%)',
                        'low' => 'Progress Rendah (<40%)',
                        'zero' => 'Belum Mulai',
                    ])
                    ->query(function ($query, $state) {
                        if (! $state) {
                            return $query;
                        }

                        return $query->having('material_progress_count', '>', 0)
                            ->when($state === 'high', fn ($q) => $q->havingRaw('(completed_materials / material_progress_count) >= 0.7'))
                            ->when($state === 'medium', fn ($q) => $q->havingRaw('(completed_materials / material_progress_count) >= 0.4 AND (completed_materials / material_progress_count) < 0.7'))
                            ->when($state === 'low', fn ($q) => $q->havingRaw('(completed_materials / material_progress_count) < 0.4'))
                            ->when($state === 'zero', fn ($q) => $q->having('material_progress_count', '=', 0));
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
