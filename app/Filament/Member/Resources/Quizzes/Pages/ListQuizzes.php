<?php

namespace App\Filament\Member\Resources\Quizzes\Pages;

use App\Filament\Member\Resources\Quizzes\QuizResource;
use Filament\Resources\Pages\ListRecords;

class ListQuizzes extends ListRecords
{
    protected static string $resource = QuizResource::class;

    protected static ?string $title = 'Quiz & Evaluasi';
}
