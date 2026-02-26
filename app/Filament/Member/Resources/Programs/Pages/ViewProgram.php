<?php

namespace App\Filament\Member\Resources\Programs\Pages;

use App\Filament\Member\Resources\Programs\ProgramResource;
use App\Filament\Member\Resources\Programs\RelationManagers\MaterialsRelationManager;
use App\Filament\Member\Resources\Programs\RelationManagers\QuizzesRelationManager;
use Filament\Resources\Pages\ViewRecord;

class ViewProgram extends ViewRecord
{
    protected static string $resource = ProgramResource::class;

    public function getRelationManagers(): array
    {
        return [
            MaterialsRelationManager::class,
            QuizzesRelationManager::class,
        ];
    }
}
