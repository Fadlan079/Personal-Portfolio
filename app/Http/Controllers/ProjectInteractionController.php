<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectComment;
use Illuminate\Http\Request;

class ProjectInteractionController extends Controller
{
    public function show($id)
    {
        $project = Project::with([
            'comments.user', 
            'comments.replies.user', 
            'comments.likes.user', 
            'comments.replies.likes.user'
        ])->findOrFail($id);

        $likesCount = $project->likes()->count();
        $userLiked = false;

        if (auth()->check()) {
            $userLiked = $project->likes()->where('user_id', auth()->id())->exists();
        }

        $commentsData = $project->comments->sortByDesc(function ($comment) {
            $likesPart = str_pad($comment->likes->count(), 5, '0', STR_PAD_LEFT);
            return ($comment->is_pinned ? '1_' : '0_') . $likesPart . '_' . $comment->created_at->timestamp;
        })->values()->map(function ($comment) {
            
            $creatorLiked = $comment->likes->contains(function ($like) {
                return $like->user && $like->user->role === 'admin';
            });
            $isUserLiked = auth()->check() ? $comment->likes->where('user_id', auth()->id())->isNotEmpty() : false;

            return [
                'id' => $comment->id,
                'content' => $comment->content,
                'is_pinned' => (bool) $comment->is_pinned,
                'likes_count' => $comment->likes->count(),
                'user_liked' => $isUserLiked,
                'creator_liked' => $creatorLiked,
                'user' => [
                    'name' => $comment->user->name ?? 'Unknown',
                    'profile_photo_url' => $comment->user->profile_photo_url ?? asset('profile.jpg'),
                    'role' => $comment->user->role ?? 'user',
                ],
                'created_at' => $comment->created_at->diffForHumans(),
                'replies' => $comment->replies->sortBy('created_at')->values()->map(function ($reply) use ($comment) {
                    
                    $rCreatorLiked = $reply->likes->contains(function ($like) {
                        return $like->user && $like->user->role === 'admin';
                    });
                    $rUserLiked = auth()->check() ? $reply->likes->where('user_id', auth()->id())->isNotEmpty() : false;

                    return [
                        'id' => $reply->id,
                        'parent_id' => $comment->id,
                        'content' => $reply->content,
                        'likes_count' => $reply->likes->count(),
                        'user_liked' => $rUserLiked,
                        'creator_liked' => $rCreatorLiked,
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
            'active_user_role' => auth()->check() ? auth()->user()->role : 'guest',
            'comments' => $commentsData
        ]);
    }
}
