<?php

namespace App\Filament\Member\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class MemberStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();

        return [
            Stat::make('Materi Selesai', $user->materialProgress()->where('status', 'completed')->count())
                ->description('Total materi yang diselesaikan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Sedang Belajar', $user->materialProgress()->where('status', 'in_progress')->count())
                ->description('Materi dalam progress')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('info'),

            Stat::make('Total Materi', $user->materialProgress()->count())
                ->description('Materi yang diakses')
                ->descriptionIcon('heroicon-m-document-duplicate')
                ->color('warning'),
        ];
    }
}
