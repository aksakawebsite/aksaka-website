<?php

namespace App\Filament\Member\Resources\Programs\Pages;

use App\Filament\Member\Resources\Programs\ProgramResource;
use Filament\Resources\Pages\ViewRecord;

class ViewProgram extends ViewRecord
{
    protected static string $resource = ProgramResource::class;

    public function getView(): string
    {
        return 'filament.member.resources.programs.view';
    }
}
