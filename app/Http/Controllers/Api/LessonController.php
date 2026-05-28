<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Progress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user    = $request->user();
        $lessons = Lesson::where('is_published', true)->orderBy('order')->get();

        $progressMap = Progress::where('user_id', $user->id)
                               ->whereIn('lesson_id', $lessons->pluck('id'))
                               ->get()
                               ->keyBy('lesson_id');

        $previousComplete = true; // lesson 1 is always unlocked

        $result = $lessons->map(function (Lesson $lesson) use ($progressMap, &$previousComplete, $user) {
            $progress  = $progressMap[$lesson->id] ?? null;
            $isLocked  = !$previousComplete;
            // Freemium: non-free lessons are locked if not yet unlocked (regardless of previous)
            // For now: is_free lessons (1,2) are always accessible, others need previous complete
            $isLocked = !$lesson->is_free && $isLocked;

            $previousComplete = $progress && $progress->status === 'complete';

            return $this->formatLesson($lesson, $progress, $isLocked);
        });

        return response()->json(['lessons' => $result]);
    }

    public function show(Request $request, Lesson $lesson): JsonResponse
    {
        if (!$lesson->is_published) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $progress = Progress::where('user_id', $request->user()->id)
                            ->where('lesson_id', $lesson->id)
                            ->first();

        return response()->json($this->formatLesson($lesson, $progress, false));
    }

    private function formatLesson(Lesson $lesson, ?Progress $progress, bool $isLocked): array
    {
        return [
            'id'            => $lesson->id,
            'order'         => $lesson->order,
            'title'         => $lesson->title,
            'description'   => $lesson->description,
            'mode_support'  => $lesson->mode_support,
            'note_sequence' => $lesson->note_sequence,
            'tempo_target'  => $lesson->tempo_target,
            'xp_completion' => $lesson->xp_completion,
            'xp_perfect'    => $lesson->xp_perfect,
            'is_free'       => $lesson->is_free,
            'is_locked'     => $isLocked,
            'progress'      => $progress ? [
                'status'     => $progress->status,
                'stars'      => $progress->stars,
                'best_score' => $progress->best_score,
            ] : null,
        ];
    }
}
