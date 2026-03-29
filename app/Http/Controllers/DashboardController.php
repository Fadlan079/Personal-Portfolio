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

        $recentProjects = Project::with('skills')->recent(3)->get();
        $latestProject = Project::latest('updated_at')->first();
        $recentMessages = Contact::latest()->take(5)->get();

        return view('dashboard.index', [
            'recentProjects' => $recentProjects,
            'latestProject' => $latestProject,
            'projectSummary' => $projectSummary,
            'unreadMessagesCount' => $unreadMessagesCount,
            'skillSummary' => $skillSummary,
            'topSkillCategory' => $topSkillCategory,
            'recentMessages' => $recentMessages,
        ]);
    }
}
