<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectComment extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'parent_id',
        'content',
    ];

    // RELATIONSHIPS

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Reply ke comment ini
    public function replies()
    {
        return $this->hasMany(ProjectComment::class, 'parent_id');
    }

    // Parent comment (kalau ini reply)
    public function parent()
    {
        return $this->belongsTo(ProjectComment::class, 'parent_id');
    }
}
