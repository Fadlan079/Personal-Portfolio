<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $fillable = ['user_id', 'project_comment_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projectComment()
    {
        return $this->belongsTo(ProjectComment::class);
    }
}
