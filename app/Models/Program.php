<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'title',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function materials()
    {
        return $this->hasMany(Material::class)->orderBy('order');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class)->orderBy('order');
    }
}
