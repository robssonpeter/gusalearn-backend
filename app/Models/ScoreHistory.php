<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoreHistory extends Model
{
    protected $table = 'score_history';

    protected $fillable = [
        'user_id', 'lesson_id', 'score', 'stars', 'timing_score',
        'mode', 'xp_earned', 'played_at',
    ];

    protected function casts(): array
    {
        return [
            'played_at' => 'datetime',
        ];
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lesson(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
