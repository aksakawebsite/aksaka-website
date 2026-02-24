<?php

namespace App\Filament\Member\Resources\Quizzes;

use App\Filament\Member\Resources\Quizzes\Pages\ListQuizzes;
use App\Models\Quiz;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static ?string $navigationLabel = 'Quiz & Evaluasi';

    protected static ?string $modelLabel = 'Quiz';

    protected static ?int $navigationSort = 2;

    public static function table(Table $table): Table
    {
        return $table
            ->query(
                Quiz::query()
                    ->whereNotNull('gform_url')
                    ->whereHas('program')
                    ->with('program')
            )
            ->columns([
                TextColumn::make('program.title')
                    ->label('Program')
                    ->badge()
                    ->color('info'),
                TextColumn::make('title')
                    ->label('Quiz')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->wrap(),
            ])
            ->recordActions([
                \Filament\Actions\Action::make('take')
                    ->label('Kerjakan Quiz')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('success')
                    ->url(fn ($record) => $record->gform_url)
                    ->openUrlInNewTab(),
            ])
            ->defaultSort('order', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuizzes::route('/'),
        ];
    }
}
