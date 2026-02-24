<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = [
        'quiz_id',
        'user_id',
        'score',
        'total_points',
        'percentage',
        'passed',
        'started_at',
        'completed_at',
        'time_taken_seconds',
        'attempt_number',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'passed' => 'boolean',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questionAnswers()
    {
        return $this->hasMany(QuestionAnswer::class);
    }

    public function calculateScore()
    {
        $earnedPoints = $this->questionAnswers()->sum('points_earned');
        $this->score = $earnedPoints;
        $this->percentage = $this->total_points > 0 ? round(($earnedPoints / $this->total_points) * 100) : 0;
        $this->passed = $this->percentage >= $this->quiz->passing_score;
        $this->save();
    }
}
