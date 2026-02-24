<?php

namespace App\Filament\Resources\Quizzes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuizForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Quiz')
                    ->components([
                        Select::make('program_id')
                            ->relationship('program', 'title')
                            ->required()
                            ->label('Program'),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('Judul Quiz'),
                        Textarea::make('description')
                            ->rows(3)
                            ->label('Deskripsi'),
                        TextInput::make('gform_url')
                            ->url()
                            ->required()
                            ->label('Google Form URL')
                            ->helperText('Link Google Form untuk quiz ini')
                            ->placeholder('https://docs.google.com/forms/d/e/...'),
                        TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->label('Urutan'),
                    ])->columns(2),
            ]);
    }
}
