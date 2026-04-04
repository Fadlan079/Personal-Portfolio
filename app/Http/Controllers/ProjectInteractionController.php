<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectComment;
use Illuminate\Http\Request;

class ProjectInteractionController extends Controller
{
    public function show($id)
    {
        $project = Project::with(['comments.user', 'comments.replies.user'])->findOrFail($id);

        $likesCount = $project->likes()->count();
        $userLiked = false;

        if (auth()->check()) {
            $userLiked = $project->likes()->where('user_id', auth()->id())->exists();
        }

        $commentsData = $project->comments->sortByDesc('created_at')->values()->map(function ($comment) {
            return [
                'id' => $comment->id,
                'content' => $comment->content,
                'user' => [
                    'name' => $comment->user->name ?? 'Unknown',
                    'profile_photo_url' => $comment->user->profile_photo_url ?? asset('profile.jpg'),
                    'role' => $comment->user->role ?? 'user',
                ],
                'created_at' => $comment->created_at->diffForHumans(),
                'replies' => $comment->replies->sortBy('created_at')->values()->map(function ($reply) use ($comment) {
                    return [
                        'id' => $reply->id,
                        'parent_id' => $comment->id,
                        'content' => $reply->content,
                        'user' => [
                            'name' => $reply->user->name ?? 'Unknown',
                            'profile_photo_url' => $reply->user->profile_photo_url ?? asset('profile.jpg'),
                            'role' => $reply->user->role ?? 'user',
                        ],
                        'created_at' => $reply->created_at->diffForHumans(),
                    ];
                })
            ];
        });

        $totalComments = ProjectComment::where('project_id', $project->id)->count();

        return response()->json([
            'likes_count' => $likesCount,
            'user_liked' => $userLiked,
            'comments_count' => $totalComments,
            'comments' => $commentsData
        ]);
    }
}
