<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Contact;
use App\Models\Skill;

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
        ]);
    }
}
