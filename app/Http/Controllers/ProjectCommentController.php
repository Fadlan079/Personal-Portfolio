<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectComment;
use App\Models\Project;

class ProjectCommentController extends Controller
{
    public function store(Request $request, $projectId)
    {
        // 1. Auth check
        if (!auth()->check()) {
            abort(403);
        }

        // 2. Validasi
        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
        ]);

        // 3. Pastikan project ada
        $project = Project::findOrFail($projectId);

        $comment = ProjectComment::create([
            'user_id' => auth()->id(),
            'project_id' => $project->id,
            'content' => $request->content,
            'parent_id' => null
        ]);

        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'content' => $comment->content,
                'user' => [
                    'name' => auth()->user()->name,
                    'profile_photo_url' => auth()->user()->profile_photo_url,
                    'role' => auth()->user()->role,
                ],
                'created_at' => $comment->created_at->diffForHumans(),
                'replies' => []
            ]
        ]);
    }

    public function reply(Request $request, $projectId)
    {
        if (!auth()->check()) {
            abort(403);
        }

        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
            'parent_id' => ['required', 'exists:project_comments,id']
        ]);

        $project = Project::findOrFail($projectId);

        // Pastikan parent comment milik project yang sama
        $parent = ProjectComment::where('id', $request->parent_id)
            ->where('project_id', $project->id)
            ->firstOrFail();

        $reply = ProjectComment::create([
            'user_id' => auth()->id(),
            'project_id' => $project->id,
            'content' => $request->content,
            'parent_id' => $parent->id
        ]);

        return response()->json([
            'success' => true,
            'reply' => [
                'id' => $reply->id,
                'parent_id' => $parent->id,
                'content' => $reply->content,
                'user' => [
                    'name' => auth()->user()->name,
                    'profile_photo_url' => auth()->user()->profile_photo_url,
                    'role' => auth()->user()->role,
                ],
                'created_at' => $reply->created_at->diffForHumans(),
            ]
        ]);
    }

    public function like($commentId)
    {
        $comment = ProjectComment::findOrFail($commentId);
        $user = auth()->user();

        $existingLike = \App\Models\CommentLike::where('user_id', $user->id)
            ->where('project_comment_id', $comment->id)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            return response()->json(['success' => true, 'liked' => false]);
        } else {
            \App\Models\CommentLike::create([
                'user_id' => $user->id,
                'project_comment_id' => $comment->id
            ]);
            return response()->json(['success' => true, 'liked' => true]);
        }
    }

    public function pin($commentId)
    {
        $comment = ProjectComment::findOrFail($commentId);
        
        // Hanya komentar utama yang bisa dipin
        if ($comment->parent_id !== null) {
            return response()->json(['success' => false, 'message' => 'Hanya komentar utama yang dapat disematkan.'], 400);
        }

        $comment->is_pinned = !$comment->is_pinned;
        $comment->save();

        return response()->json(['success' => true, 'is_pinned' => $comment->is_pinned]);
    }

    public function destroy($commentId)
    {
        $comment = ProjectComment::findOrFail($commentId);
        $comment->delete();

        return response()->json(['success' => true]);
    }
}
