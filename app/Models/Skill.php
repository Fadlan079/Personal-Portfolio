<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'category', 'icon'];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public static function summary(): array
    {
        $skills = self::all();
        $categoryCount = $skills->groupBy('category')->map->count();

        return [
            'totalSkills' => $skills->count(),
            'frontendCount' => $categoryCount['frontend'] ?? 0,
            'backendCount' => $categoryCount['backend'] ?? 0,
            'toolsCount' => $categoryCount['tools'] ?? 0,
            'otherCount' => $skills->count() - ($categoryCount['frontend'] ?? 0) - ($categoryCount['backend'] ?? 0) - ($categoryCount['tools'] ?? 0)
        ];
    }
}
