<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $fillable = [
        'program_id',
        'title',
        'gform_url',
        'description',
        'order',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
