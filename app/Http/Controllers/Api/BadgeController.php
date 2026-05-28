<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Models\UserBadge;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user     = $request->user();
        $earned   = UserBadge::where('user_id', $user->id)->get()->keyBy('badge_id');
        $badges   = Badge::orderBy('id')->get();

        $result = $badges->map(fn(Badge $badge) => [
            'key'         => $badge->key,
            'title'       => $badge->title,
            'description' => $badge->description,
            'icon'        => $badge->icon,
            'earned'      => isset($earned[$badge->id]),
            'awarded_at'  => isset($earned[$badge->id])
                                ? $earned[$badge->id]->awarded_at->toDateString()
                                : null,
        ]);

        return response()->json(['badges' => $result]);
    }
}
