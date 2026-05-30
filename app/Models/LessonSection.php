<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonSection extends Model
{
    protected $fillable = [
        'lesson_id', 'display_order', 'section_type', 'xp_reward', 'data',
    ];

    protected function casts(): array
    {
        return ['data' => 'array'];
    }

    public function lesson(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
