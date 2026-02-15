<?php

namespace App\Filament\Resources\Materials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MaterialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Materi')
                    ->schema([
                        Select::make('program_id')
                            ->relationship('program', 'title')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Program Pembelajaran'),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('Judul Materi'),
                        Select::make('type')
                            ->options([
                                'video' => '🎥 Video Pembelajaran',
                                'pdf' => '📄 E-Book / PDF',
                            ])
                            ->required()
                            ->reactive()
                            ->label('Tipe Materi'),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull()
                            ->label('Deskripsi'),
                        TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->label('Urutan')
                            ->helperText('Urutan tampilan materi dalam program'),
                    ])->columns(2),

                Section::make('Konten Materi')
                    ->description('Upload PDF atau masukkan link video YouTube')
                    ->schema([
                        FileUpload::make('content_url')
                            ->label('Upload PDF')
                            ->disk('public')
                            ->directory('materials/pdfs')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(5120)
                            ->visible(fn ($get) => $get('type') === 'pdf')
                            ->helperText('Maksimal 5MB untuk file PDF')
                            ->required(fn ($get) => $get('type') === 'pdf'),

                        TextInput::make('content_url')
                            ->label('Link Video YouTube')
                            ->url()
                            ->placeholder('https://www.youtube.com/watch?v=...')
                            ->visible(fn ($get) => $get('type') === 'video')
                            ->helperText('Masukkan link YouTube untuk video pembelajaran')
                            ->required(fn ($get) => $get('type') === 'video')
                            ->rule('regex:/^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[\w-]+/')
                            ->validationMessages([
                                'regex' => 'Link harus berupa URL YouTube yang valid',
                            ]),
                    ]),
            ]);
    }
}
