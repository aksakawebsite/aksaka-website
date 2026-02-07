<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    public function activityLogs()
    {
        return $this->hasMany(UserActivityLog::class);
    }

    public function materialProgress()
    {
        return $this->hasMany(UserMaterialProgress::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'user_material_progress')
            ->withPivot('status', 'started_at', 'completed_at')
            ->withTimestamps();
    }
}
