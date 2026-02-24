<?php

namespace App\Filament\Member\Resources\Programs;

use App\Filament\Member\Resources\Programs\Pages\ListPrograms;
use App\Filament\Member\Resources\Programs\Pages\ViewProgram;
use App\Models\Program;
use BackedEnum;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $navigationLabel = 'Program Pembelajaran';

    protected static ?string $modelLabel = 'Program';

    public static function table(Table $table): Table
    {
        return $table
            ->query(Program::query()->where('is_active', true)->withCount(['materials', 'quizzes']))
            ->columns([
                TextColumn::make('title')->label('Program')->searchable(),
                TextColumn::make('materials_count')->label('Materi')->badge()->color('info'),
                TextColumn::make('quizzes_count')->label('Quiz')->badge()->color('warning'),
            ])
            ->recordActions([
                ViewAction::make()->label('Lihat Detail'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPrograms::route('/'),
            'view' => ViewProgram::route('/{record}'),
        ];
    }
}
