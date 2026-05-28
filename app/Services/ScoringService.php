<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\Progress;
use App\Models\ScoreHistory;
use App\Models\User;
use Carbon\Carbon;

class ScoringService
{
    public function process(User $user, Lesson $lesson, array $data): array
    {
        $score      = $data['score'];
        $stars      = $data['stars'];
        $mode       = $data['mode'];
        $playedAt   = Carbon::parse($data['played_at']);
        $timingScore = $data['timing_score'] ?? null;

        // 1. Insert score history row
        ScoreHistory::create([
            'user_id'      => $user->id,
            'lesson_id'    => $lesson->id,
            'score'        => $score,
            'stars'        => $stars,
            'timing_score' => $timingScore,
            'mode'         => $mode,
            'xp_earned'    => 0, // will be updated below
            'played_at'    => $playedAt,
        ]);

        // 2. Upsert progress
        $progress = Progress::firstOrNew([
            'user_id'   => $user->id,
            'lesson_id' => $lesson->id,
        ]);

        $isFirstCompletion = !$progress->exists || $progress->status !== 'complete';
        $isFirstPerfect    = $stars >= 2 && ($progress->stars < 2);

        if (!$progress->exists || $score > $progress->best_score) {
            $progress->best_score = $score;
        }
        if (!$progress->exists || $stars > $progress->stars) {
            $progress->stars = $stars;
        }
        if ($score >= 1 && $progress->status !== 'complete') {
            $progress->status       = 'complete';
            $progress->completed_at = $progress->completed_at ?? now();
        }
        $progress->save();

        // 3. Calculate and award XP
        $xpEarned = 0;
        if ($isFirstCompletion && $progress->status === 'complete') {
            $xpEarned += $lesson->xp_completion;
        }
        if ($isFirstPerfect) {
            $xpEarned += $lesson->xp_perfect;
        }

        if ($xpEarned > 0) {
            $user->xp += $xpEarned;
            $user->level = self::levelFromXp($user->xp);
        }

        // 4. Update streak
        $levelBefore  = $user->level;
        [$streakCount] = (new StreakService())->update($user);
        $leveledUp = $user->level > $levelBefore;

        $user->save();

        // Update xp_earned on the history row
        ScoreHistory::where('user_id', $user->id)
                    ->where('lesson_id', $lesson->id)
                    ->latest('played_at')
                    ->first()
                    ?->update(['xp_earned' => $xpEarned]);

        return [
            'xp_earned'    => $xpEarned,
            'total_xp'     => $user->xp,
            'level'        => $user->level,
            'level_name'   => self::levelName($user->level),
            'level_up'     => $leveledUp,
            'streak_count' => $user->streak_count,
            'stars'        => $progress->stars,
            'best_score'   => $progress->best_score,
        ];
    }

    public static function levelFromXp(int $xp): int
    {
        $levels = config('gusalevel.levels');
        $level  = 1;
        foreach ($levels as $num => $data) {
            if ($xp >= $data['min_xp']) {
                $level = $num;
            }
        }
        return $level;
    }

    public static function levelName(int $level): string
    {
        return config("gusalevel.levels.{$level}.name", "Level {$level}");
    }

    public static function xpToNextLevel(int $xp, int $level): int
    {
        $levels   = config('gusalevel.levels');
        $nextLevel = $level + 1;
        if (!isset($levels[$nextLevel])) {
            return 0; // max level
        }
        return max(0, $levels[$nextLevel]['min_xp'] - $xp);
    }
}
