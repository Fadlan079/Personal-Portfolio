<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Contact;
use App\Models\Skill;
use App\Models\ProjectComment;

class DashboardController extends Controller
{
    public function index()
    {
        $projectSummary = Project::summary(false);
        $unreadMessagesCount = Contact::where('is_read', false)->count();

        $skillSummary = Skill::summary();
        $categories = [
            'Frontend' => $skillSummary['frontendCount'] ?? 0,
            'Backend' => $skillSummary['backendCount'] ?? 0,
            'Tools' => $skillSummary['toolsCount'] ?? 0,
            'Other' => $skillSummary['otherCount'] ?? 0,
        ];
        arsort($categories);
        $topSkillCategory = array_key_first($categories);
        $topSkillCount = $categories[$topSkillCategory] ?? 0;

        $skillStyles = [
            'frontend' => ['icon' => 'fa-code', 'color' => 'text-sky-400'],
            'backend' => ['icon' => 'fa-server', 'color' => 'text-rose-400'],
            'tools' => ['icon' => 'fa-screwdriver-wrench', 'color' => 'text-lime-500'],
            'other' => ['icon' => 'fa-layer-group', 'color' => 'text-purple-500'],
        ];

        $currentStyle = $skillStyles[strtolower($topSkillCategory)] ?? $skillStyles['other'];
        $topSkillIcon = $currentStyle['icon'];
        $topSkillColor = $currentStyle['color'];

        $recentProjects = Project::with('skills')->recent(3)->get();
        $latestProject = Project::latest('updated_at')->first();
        $recentMessages = Contact::latest()->take(5)->get();

        $allProjects = Project::all(['type', 'status', 'tech', 'updated_at']);

        $topProjectCategory = $allProjects->groupBy('type')
            ->map->count()->sortDesc()->keys()->first() ?? '-';

        $topProjectStatus = $allProjects->groupBy('status')
            ->map->count()->sortDesc()->keys()->first() ?? '-';

        $allTech = $allProjects->pluck('tech')->flatten()->filter();
        $techCounts = array_count_values($allTech->toArray());
        arsort($techCounts);
        $topTechStackAllTime = array_key_first($techCounts) ?? '-';

        $monthTech = $allProjects->where('updated_at', '>=', now()->subDays(7))
            ->pluck('tech')->flatten()->filter();
        $monthTechCounts = array_count_values($monthTech->toArray());
        arsort($monthTechCounts);
        $topTechStackMonth = array_key_first($monthTechCounts) ?? '-';

        // --- Engagement Charts Data ---

        // 1. Top 5 Projects by Likes
        $topByLikes = Project::withCount('likes')
            ->orderByDesc('likes_count')
            ->limit(5)
            ->get(['id', 'title']);
        $topLikesChart = [
            'labels' => $topByLikes->pluck('title')->map(fn($t) => strlen($t) > 18 ? substr($t, 0, 18).'…' : $t)->toArray(),
            'data'   => $topByLikes->pluck('likes_count')->toArray(),
        ];

        // 2. Top 5 Projects by Comments
        $topByComments = Project::withCount('comments')
            ->orderByDesc('comments_count')
            ->limit(5)
            ->get(['id', 'title']);
        $topCommentsChart = [
            'labels' => $topByComments->pluck('title')->map(fn($t) => strlen($t) > 18 ? substr($t, 0, 18).'…' : $t)->toArray(),
            'data'   => $topByComments->pluck('comments_count')->toArray(),
        ];

        // 3. Comments Over Time (last 30 days)
        $commentsOverTime = [];
        for ($i = 29; $i >= 0; $i--) {
            $day = now()->subDays($i);
            $commentsOverTime[$day->format('M d')] = 0;
        }
        ProjectComment::where('created_at', '>=', now()->subDays(30))
            ->get(['created_at'])
            ->each(function ($c) use (&$commentsOverTime) {
                $key = $c->created_at->format('M d');
                if (isset($commentsOverTime[$key])) {
                    $commentsOverTime[$key]++;
                }
            });
        $commentsOverTimeChart = [
            'labels' => array_keys($commentsOverTime),
            'data'   => array_values($commentsOverTime),
        ];

        // 4. Pinned vs Normal Comments
        $pinnedCount  = ProjectComment::where('is_pinned', true)->count();
        $normalCount  = ProjectComment::where('is_pinned', false)->orWhereNull('is_pinned')->count();
        $pinnedVsNormalChart = [
            'pinned' => $pinnedCount,
            'normal' => $normalCount,
        ];

        return view('dashboard.index', [
            'recentProjects' => $recentProjects,
            'latestProject' => $latestProject,
            'projectSummary' => $projectSummary,
            'unreadMessagesCount' => $unreadMessagesCount,
            'skillSummary' => $skillSummary,
            'topSkillCategory' => $topSkillCategory,
            'recentMessages' => $recentMessages,
            'topProjectCategory' => $topProjectCategory,
            'topProjectStatus' => $topProjectStatus,
            'topTechStackAllTime' => $topTechStackAllTime,
            'topTechStackMonth' => $topTechStackMonth,
            'topSkillIcon' => $topSkillIcon,
            'topSkillColor' => $topSkillColor,
            'topSkillCount' => $topSkillCount,
            // Engagement Charts
            'topLikesChart' => $topLikesChart,
            'topCommentsChart' => $topCommentsChart,
            'commentsOverTimeChart' => $commentsOverTimeChart,
            'pinnedVsNormalChart' => $pinnedVsNormalChart,
        ]);
    }
}
