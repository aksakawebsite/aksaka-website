<?php

namespace App\Filament\Member\Resources\Programs\RelationManagers;

use App\Models\Quiz;
use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuizzesRelationManager extends RelationManager
{
    protected static string $relationship = 'quizzes';

    protected static ?string $title = 'Quiz & Evaluasi';

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
            ->query(
                fn () => Quiz::query()
                    ->where('program_id', $this->getOwnerRecord()->getKey())
                    ->whereNotNull('gform_url')
                    ->orderBy('order')
            )
            ->columns([
                TextColumn::make('order')
                    ->label('#')
                    ->sortable()
                    ->width('40px'),
                TextColumn::make('title')
                    ->label('Judul Quiz')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->state(function ($record) {
                        return \App\Models\UserActivityLog::where('user_id', \Illuminate\Support\Facades\Auth::id())
                            ->where('activity', 'Menyelesaikan quiz: '.$record->title)
                            ->exists() ? 'Selesai' : 'Belum';
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Selesai' => 'success',
                        default => 'warning',
                    }),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->wrap()
                    ->limit(80),
            ])
            ->defaultSort('order')
            ->recordActions([
                Action::make('kerjakan')
                    ->label('Kerjakan Quiz')
                    ->url(fn ($record) => $record->gform_url)
                    ->openUrlInNewTab()
                    ->button()
                    ->color('warning'),
                Action::make('complete')
                    ->label('✓ Tandai Selesai')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->button()
                    ->visible(fn ($record) => ! \App\Models\UserActivityLog::where('user_id', \Illuminate\Support\Facades\Auth::id())
                        ->where('activity', 'Menyelesaikan quiz: '.$record->title)
                        ->exists())
                    ->action(function ($record) {
                        \App\Models\UserActivityLog::create([
                            'user_id' => \Illuminate\Support\Facades\Auth::id(),
                            'activity' => 'Menyelesaikan quiz: '.$record->title,
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Berhasil')
                            ->body('Quiz berhasil ditandai selesai!')
                            ->success()
                            ->send();
                    }),
            ])
            ->headerActions([]);
    }
}
