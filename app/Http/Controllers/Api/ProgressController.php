<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\ScoreHistory;
use App\Services\BadgeService;
use App\Services\ScoringService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function complete(Request $request, Lesson $lesson): JsonResponse
    {
        $data = $request->validate([
            'score'        => 'required|integer|min:0|max:100',
            'stars'        => 'required|integer|min:0|max:3',
            'timing_score' => 'nullable|integer',
            'mode'         => 'required|in:screen,piano',
            'played_at'    => 'required|date',
        ]);

        $user = $request->user();

        $result    = (new ScoringService())->process($user, $lesson, $data);
        $newBadges = (new BadgeService())->checkAndAward($user->fresh(), $data['mode']);

        $result['new_badges'] = $newBadges;

        return response()->json($result);
    }

    public function sync(Request $request): JsonResponse
    {
        $request->validate([
            'completions'              => 'required|array',
            'completions.*.lesson_id'  => 'required|integer|exists:lessons,id',
            'completions.*.score'      => 'required|integer|min:0|max:100',
            'completions.*.stars'      => 'required|integer|min:0|max:3',
            'completions.*.timing_score' => 'nullable|integer',
            'completions.*.mode'       => 'required|in:screen,piano',
            'completions.*.played_at'  => 'required|date',
        ]);

        $user        = $request->user();
        $processed   = 0;
        $skipped     = 0;
        $allNewBadges = [];

        $completions = collect($request->completions)
                        ->sortBy('played_at');

        foreach ($completions as $item) {
            $playedAt = Carbon::parse($item['played_at']);

            // Idempotency: skip if same lesson + played_at already exists
            $exists = ScoreHistory::where('user_id', $user->id)
                                  ->where('lesson_id', $item['lesson_id'])
                                  ->where('played_at', $playedAt)
                                  ->exists();
            if ($exists) {
                $skipped++;
                continue;
            }

            $lesson = Lesson::find($item['lesson_id']);
            (new ScoringService())->process($user, $lesson, $item);
            $processed++;
        }

        $user->refresh();
        $newBadges = (new BadgeService())->checkAndAward($user, 'screen');

        return response()->json([
            'processed'    => $processed,
            'skipped'      => $skipped,
            'total_xp'     => $user->xp,
            'level'        => $user->level,
            'streak_count' => $user->streak_count,
            'new_badges'   => $newBadges,
        ]);
    }
}
