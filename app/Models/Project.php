<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    // protected $table = 'projects';

    protected $fillable = [
        'title',
        'type',
        'desc',
        'role',
        'team_size',
        'responsibilities',
        'status',
        'tech',
        'repo',
        'live_url',
        'screenshot',
    ];

    protected $casts = [
        'tech' => 'array',
        'screenshot' => 'array',
    ];

    public function scopeSearch($query, $keyword)
    {
        $keyword = strtolower($keyword);

        return $query->where(function ($q) use ($keyword) {
            $q->whereRaw('LOWER(title) LIKE ?', ["%{$keyword}%"])
            ->orWhereRaw('LOWER(`type`) LIKE ?', ["%{$keyword}%"])
            ->orWhereRaw('LOWER(`desc`) LIKE ?', ["%{$keyword}%"])
            ->orWhereRaw('LOWER(status) LIKE ?', ["%{$keyword}%"])
            ->orWhereRaw('LOWER(tech) LIKE ?', ["%{$keyword}%"]);
        });
    }

    public function scopeRecent($query, int $limit = 3)
    {
        return $query->latest()->limit($limit);
    }

    public function scopeFilterType($query, string $type)
    {
        $map = [
            'website' => ['Website', 'Web App'],
            'application' => ['Application'],
            'design' => ['Design'],
        ];

        if (isset($map[strtolower($type)])) {
            return $query->whereIn('type', $map[strtolower($type)]);
        }

        return $query->where('type', $type);
    }

    public function getVisibleTechsAttribute(): array
    {
        return array_slice($this->tech ?? [], 0, 3);
    }

    public function getExtraTechsAttribute(): array
    {
        return array_slice($this->tech ?? [], 3);
    }

    public function getStatusClassAttribute(): string
    {
        return match ($this->status) {
            'In Progress'         => 'bg-warning/10 text-yellow-500 border-warning/30',
            'Archived', 'Shipped' => 'bg-success/10 text-green-500 border-success/30',
            'Prototype'           => 'bg-muted/10 text-muted border-border',
            default               => 'bg-muted/10 text-muted border-border',
        };
    }

    public static function summary(): array
    {
        $projects = self::all();

        $statusCount = $projects->groupBy('status')->map->count();

        return [
            'totalProjects'   => $projects->count(),
            'totalCategories' => $projects->pluck('type')->filter()->unique()->count(),

            'activeCount' =>
                ($statusCount['Shipped'] ?? 0) +
                ($statusCount['In Progress'] ?? 0),

            'inactiveCount' =>
                ($statusCount['Prototype'] ?? 0) +
                ($statusCount['Archived'] ?? 0),

            'statusBreakdown' => [
                'Shipped'     => $statusCount['Shipped'] ?? 0,
                'In Progress' => $statusCount['In Progress'] ?? 0,
                'Prototype'   => $statusCount['Prototype'] ?? 0,
                'Archived'    => $statusCount['Archived'] ?? 0,
            ],
        ];
    }
}
