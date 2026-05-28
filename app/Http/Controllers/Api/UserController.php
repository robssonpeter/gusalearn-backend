<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ScoringService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $user = $request->user()->load(['userBadges.badge']);

        $badges = $user->userBadges->map(fn($ub) => [
            'key'        => $ub->badge->key,
            'title'      => $ub->badge->title,
            'icon'       => $ub->badge->icon,
            'awarded_at' => $ub->awarded_at->toDateString(),
        ]);

        return response()->json([
            'id'                 => $user->id,
            'name'               => $user->name,
            'language'           => $user->language,
            'xp'                 => $user->xp,
            'level'              => $user->level,
            'level_name'         => ScoringService::levelName($user->level),
            'xp_to_next_level'   => ScoringService::xpToNextLevel($user->xp, $user->level),
            'streak_count'       => $user->streak_count,
            'last_practice_date' => $user->last_practice_date?->toDateString(),
            'badges'             => $badges,
        ]);
    }
}
