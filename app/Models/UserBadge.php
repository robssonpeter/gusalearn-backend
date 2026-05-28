<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'badge_id', 'awarded_at'];

    protected function casts(): array
    {
        return ['awarded_at' => 'datetime'];
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function badge(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Badge::class);
    }
}
