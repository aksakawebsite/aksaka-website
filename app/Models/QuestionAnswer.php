<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $fillable = [
        'quiz_attempt_id',
        'question_id',
        'user_answer',
        'is_correct',
        'points_earned',
        'feedback',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function quizAttempt()
    {
        return $this->belongsTo(QuizAttempt::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
