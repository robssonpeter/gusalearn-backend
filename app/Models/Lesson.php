<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'order', 'title', 'description', 'note_sequence',
        'tempo_target', 'mode_support', 'xp_completion', 'xp_perfect',
        'is_published', 'is_free',
    ];

    protected function casts(): array
    {
        return [
            'note_sequence' => 'array',
            'is_published'  => 'boolean',
            'is_free'       => 'boolean',
        ];
    }

    public function progress(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Progress::class);
    }

    public function scoreHistory(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ScoreHistory::class);
    }
}
