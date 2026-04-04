<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectLikeController extends Controller
{
    public function toggle($projectId)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $user = auth()->user();
        $project = Project::findOrFail($projectId);

        $like = $project->likes()
            ->where('user_id', $user->id)
            ->first();

        if ($like) {
            $like->delete();

            return response()->json([
                'liked' => false,
                'count' => $project->likes()->count()
            ]);
        }

        $project->likes()->create([
            'user_id' => $user->id
        ]);

        return response()->json([
            'liked' => true,
            'count' => $project->likes()->count()
        ]);
    }
}
