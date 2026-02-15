<?php

namespace App\Filament\Member\Resources\Materials\Pages;

use App\Filament\Member\Resources\Materials\MaterialResource;
use App\Models\UserActivityLog;
use App\Models\UserMaterialProgress;
use Filament\Actions\Action;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;

class ViewMaterial extends Page
{
    protected static string $resource = MaterialResource::class;

    public $record;

    public function getView(): string
    {
        return 'filament.member.resources.materials.view';
    }

    public function mount(int|string $record): void
    {
        $this->record = \App\Models\Material::findOrFail($record);
        $user = Auth::user();

        UserActivityLog::create([
            'user_id' => $user->id,
            'activity' => 'Mengakses materi: '.$this->record->title,
        ]);

        UserMaterialProgress::firstOrCreate(
            [
                'user_id' => $user->id,
                'material_id' => $this->record->id,
            ],
            [
                'status' => 'in_progress',
                'started_at' => now(),
            ]
        );
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('← Kembali')
                ->url(fn () => \App\Filament\Member\Resources\Programs\ProgramResource::getUrl('view', ['record' => $this->record->program]))
                ->color('gray'),
            Action::make('complete')
                ->label('✓ Tandai Selesai')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => $this->getProgress()?->status !== 'completed')
                ->action(function () {
                    $progress = $this->getProgress();
                    $progress->update([
                        'status' => 'completed',
                        'completed_at' => now(),
                    ]);

                    UserActivityLog::create([
                        'user_id' => Auth::id(),
                        'activity' => 'Menyelesaikan materi: '.$this->record->title,
                    ]);

                    $this->notify('success', 'Materi berhasil diselesaikan!');
                    $this->redirect(\App\Filament\Member\Resources\Programs\ProgramResource::getUrl('view', ['record' => $this->record->program]));
                }),
        ];
    }

    protected function getProgress()
    {
        return UserMaterialProgress::where('user_id', Auth::id())
            ->where('material_id', $this->record->id)
            ->first();
    }

    public function getBreadcrumbs(): array
    {
        return [
            \App\Filament\Member\Resources\Programs\ProgramResource::getUrl('index') => 'Program',
            \App\Filament\Member\Resources\Programs\ProgramResource::getUrl('view', ['record' => $this->record->program]) => $this->record->program->title,
            '#' => $this->record->title,
        ];
    }
}
