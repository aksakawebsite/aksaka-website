<?php

namespace App\Filament\Widgets;

use App\Models\Program;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProgramStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $programs = Program::withCount([
            'materials',
            'quizzes',
        ])->get();

        $stats = [];

        foreach ($programs as $program) {
            // Hitung member yang terdaftar di program ini
            // Asumsi: user yang punya progress di materi program ini dianggap terdaftar
            $enrolledUsers = User::whereHas('materialProgress', function ($query) use ($program) {
                $query->whereHas('material', function ($q) use ($program) {
                    $q->where('program_id', $program->id);
                });
            })->distinct()->count();

            $stats[] = Stat::make($program->title, $enrolledUsers.' Member')
                ->description($program->materials_count.' Materi • '.$program->quizzes_count.' Quiz')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color($program->is_active ? 'success' : 'gray')
                ->extraAttributes([
                    'class' => $program->is_active ? '' : 'opacity-75',
                ]);
        }

        if (empty($stats)) {
            $stats[] = Stat::make('Belum Ada Program', '0')
                ->description('Silakan buat program pembelajaran')
                ->descriptionIcon('heroicon-m-information-circle')
                ->color('gray');
        }

        return $stats;
    }

    protected static ?int $sort = 2;
}
