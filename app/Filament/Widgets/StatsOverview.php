<?php

namespace App\Filament\Widgets;

use App\Models\Material;
use App\Models\Program;
use App\Models\Quiz;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Member', User::where('role', 'user')->count())
                ->description('Member terdaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')
                ->chart([7, 12, 15, 20, 18, 25, User::where('role', 'user')->count()]),

            Stat::make('Total Program', Program::count())
                ->description('Program pembelajaran')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),

            Stat::make('Total Materi', Material::count())
                ->description('Materi pembelajaran')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),

            Stat::make('Total Quiz', Quiz::count())
                ->description('Quiz & evaluasi')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('primary'),
        ];
    }
}
