<?php

namespace App\Filament\Member\Resources\Materials;

use App\Filament\Member\Resources\Materials\Pages\ViewMaterial;
use App\Models\Material;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Materi Saya';

    protected static bool $shouldRegisterNavigation = false;

    public static function getPages(): array
    {
        return [
            'view' => ViewMaterial::route('/{record}'),
        ];
    }
}
