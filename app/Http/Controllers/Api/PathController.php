<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LearningPath;
use App\Models\Progress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PathController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $paths = LearningPath::where('is_published', true)
            ->orderBy('order')
            ->with(['modules' => fn ($q) => $q->where('is_published', true)])
            ->get();

        $user = $request->user(); // null for guests

        $result = $paths->map(function (LearningPath $path) use ($user) {
            $modules = $path->modules->map(function ($module) use ($user) {
                $lessonIds = $module->lessons()->pluck('id');
                $completedCount = 0;
                $totalCount = $lessonIds->count();

                if ($user && $lessonIds->isNotEmpty()) {
                    $completedCount = Progress::where('user_id', $user->id)
                        ->whereIn('lesson_id', $lessonIds)
                        ->where('status', 'complete')
                        ->count();
                }

                return [
                    'id'              => $module->id,
                    'order'           => $module->order,
                    'module_code'     => $module->module_code,
                    'title'           => $module->title,
                    'title_sw'        => $module->title_sw,
                    'description'     => $module->description,
                    'description_sw'  => $module->description_sw,
                    'lesson_count'    => $totalCount,
                    'completed_count' => $completedCount,
                ];
            });

            return [
                'id'          => $path->id,
                'order'       => $path->order,
                'title'       => $path->title,
                'title_sw'    => $path->title_sw,
                'subtitle'    => $path->subtitle,
                'subtitle_sw' => $path->subtitle_sw,
                'icon'        => $path->icon,
                'color_hex'   => $path->color_hex,
                'modules'     => $modules,
            ];
        });

        return response()->json(['paths' => $result]);
    }
}
