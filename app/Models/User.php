<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'xp', 'level',
        'streak_count', 'last_practice_date', 'language',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'last_practice_date' => 'date',
        ];
    }

    public function progress(): HasMany
    {
        return $this->hasMany(Progress::class);
    }

    public function scoreHistory(): HasMany
    {
        return $this->hasMany(ScoreHistory::class);
    }

    public function userBadges(): HasMany
    {
        return $this->hasMany(UserBadge::class);
    }

    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
                    ->withPivot('awarded_at')
                    ->withTimestamps();
    }

    public function getLevelNameAttribute(): string
    {
        return \App\Services\ScoringService::levelName($this->level);
    }

    public function getXpToNextLevelAttribute(): int
    {
        return \App\Services\ScoringService::xpToNextLevel($this->xp, $this->level);
    }
}
