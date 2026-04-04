<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Achievement extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'issuer',
        'date',
        'image_url',
        'visibility',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function scopePublic($query)
    {
        return $query->where('visibility', 'public');
    }
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
