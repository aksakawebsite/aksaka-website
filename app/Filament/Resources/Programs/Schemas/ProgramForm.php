<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Program')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('Judul Program'),
                        Textarea::make('description')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull()
                            ->label('Deskripsi Program'),
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->helperText('Program yang aktif dapat diakses oleh member')
                            ->default(false),
                    ]),
            ]);
    }
}
