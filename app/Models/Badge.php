<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = ['key', 'title', 'description', 'icon'];

    public function userBadges(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserBadge::class);
    }
}
