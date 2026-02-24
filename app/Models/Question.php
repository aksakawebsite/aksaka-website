<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'quiz_id',
        'type',
        'question',
        'options',
        'correct_answer',
        'points',
        'order',
        'explanation',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    const TYPE_MULTIPLE_CHOICE = 'multiple_choice';

    const TYPE_SHORT_ANSWER = 'short_answer';

    const TYPE_ESSAY = 'essay';

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class);
    }

    public function checkAnswer($userAnswer)
    {
        if ($this->type === self::TYPE_MULTIPLE_CHOICE || $this->type === self::TYPE_SHORT_ANSWER) {
            return trim(strtolower($userAnswer)) === trim(strtolower($this->correct_answer));
        }

        return null; // Essay needs manual grading
    }
}
