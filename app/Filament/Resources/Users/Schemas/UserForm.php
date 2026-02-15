<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Akun')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Lengkap'),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->label('Email'),
                        Select::make('role')
                            ->options([
                                'user' => 'User/Member',
                                'admin' => 'Administrator',
                            ])
                            ->default('user')
                            ->required()
                            ->label('Role'),
                        DateTimePicker::make('email_verified_at')
                            ->label('Email Terverifikasi')
                            ->helperText('Kosongkan jika email belum terverifikasi'),
                    ])->columns(2),

                Section::make('Password')
                    ->description('Kosongkan jika tidak ingin mengubah password')
                    ->schema([
                        TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->minLength(8)
                            ->label('Password')
                            ->helperText('Minimal 8 karakter'),
                        TextInput::make('password_confirmation')
                            ->password()
                            ->same('password')
                            ->requiredWith('password')
                            ->label('Konfirmasi Password')
                            ->dehydrated(false),
                    ])->columns(2),
            ]);
    }
}
