<?php

namespace App\Services;

use App\Models\Badge;
use App\Models\Progress;
use App\Models\User;
use App\Models\UserBadge;
use Carbon\Carbon;

class BadgeService
{
    public function checkAndAward(User $user, string $mode = 'screen'): array
    {
        $newBadges = [];

        $definitions = [
            'first_lesson'  => fn() => Progress::where('user_id', $user->id)
                                                ->where('status', 'complete')
                                                ->exists(),
            'streak_3'      => fn() => $user->streak_count >= 3,
            'streak_7'      => fn() => $user->streak_count >= 7,
            'perfect_score' => fn() => \App\Models\ScoreHistory::where('user_id', $user->id)
                                                                ->where('score', 100)
                                                                ->exists(),
            'piano_first'   => fn() => $mode === 'piano' && Progress::where('user_id', $user->id)
                                                                     ->where('status', 'complete')
                                                                     ->exists(),
            'all_stars'     => fn() => $this->hasAllLessonsAtThreeStars($user),
        ];

        $earned = UserBadge::where('user_id', $user->id)->pluck('badge_id')->toArray();

        foreach ($definitions as $key => $check) {
            $badge = Badge::where('key', $key)->first();
            if (!$badge) continue;
            if (in_array($badge->id, $earned)) continue;

            if ($check()) {
                UserBadge::create([
                    'user_id'    => $user->id,
                    'badge_id'   => $badge->id,
                    'awarded_at' => Carbon::now(),
                ]);
                $newBadges[] = [
                    'key'        => $badge->key,
                    'title'      => $badge->title,
                    'icon'       => $badge->icon,
                    'awarded_at' => Carbon::now()->toDateString(),
                ];
            }
        }

        return $newBadges;
    }

    private function hasAllLessonsAtThreeStars(User $user): bool
    {
        $published = \App\Models\Lesson::where('is_published', true)->count();
        if ($published === 0) return false;

        $threeStars = Progress::where('user_id', $user->id)
                              ->where('stars', 3)
                              ->whereHas('lesson', fn($q) => $q->where('is_published', true))
                              ->count();

        return $threeStars >= $published;
    }
}
