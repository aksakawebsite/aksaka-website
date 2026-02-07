<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'program_id',
        'title',
        'type',
        'content_url',
        'description',
        'order',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function userProgress()
    {
        return $this->hasMany(UserMaterialProgress::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_material_progress')
            ->withPivot('status', 'started_at', 'completed_at')
            ->withTimestamps();
    }
}
