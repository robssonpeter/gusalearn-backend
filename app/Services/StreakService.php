<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class StreakService
{
    public function update(User $user): array
    {
        $today = Carbon::today()->toDateString();
        $last  = $user->last_practice_date?->toDateString();

        if ($last === $today) {
            // Already practiced today — no change
        } elseif ($last === Carbon::yesterday()->toDateString()) {
            // Consecutive day — extend streak
            $user->streak_count++;
        } else {
            // Gap or first ever — start new streak at 1
            $user->streak_count = 1;
        }

        $user->last_practice_date = $today;

        return [$user->streak_count];
    }
}
