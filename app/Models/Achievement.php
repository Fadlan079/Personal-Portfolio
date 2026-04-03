<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'title',
        'description',
        'issuer',
        'date',
        'image_url',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
