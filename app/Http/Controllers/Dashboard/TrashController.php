<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Support\Str;

class TrashController extends Controller
{
    /**
     * Unified Trash Dashboard
     * Handles displaying Project and Skill soft-deleted models.
     * Supports AJAX filtering based on 'tab'.
     */
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'all'); // 'all', 'projects', 'skills'
        $sort = $request->get('sort', 'desc');
        $search = $request->get('search');
        $multipleSelect = $request->get('multiple_select', 0);

        // -- Projects Fetching Logic (Grouped by Month) --
        $groupedProjects = collect();
        if (in_array($tab, ['all', 'projects'])) {
            $projectsQuery = Project::onlyTrashed();
            
            if ($search) {
                $projectsQuery->where('title', 'like', "%{$search}%");
            }

            $months = $projectsQuery->clone()
                ->selectRaw("DATE_FORMAT(deleted_at, '%Y-%m') as month")
                ->distinct()
                ->orderBy('month', $sort)
                ->pluck('month');

            foreach ($months as $month) {
                $query = Project::onlyTrashed()
                    ->whereRaw("DATE_FORMAT(deleted_at, '%Y-%m') = ?", [$month])
                    ->orderBy('deleted_at', $sort);

                if ($search) {
                    $query->where('title', 'like', "%{$search}%");
                }

                if ($multipleSelect) {
                    $projects = $query->get();
                } else {
                    $projects = $query->paginate(3, ['*'], "page_projects_$month")->withQueryString();
                }

                $formattedMonth = \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y');
                $groupedProjects->put($formattedMonth, $projects);
            }
        }

        // -- Skills Fetching Logic --
        $skills = collect();
        if (in_array($tab, ['all', 'skills'])) {
            $skillsQuery = Skill::onlyTrashed()->orderBy('deleted_at', $sort);
            
            if ($search) {
                $skillsQuery->where('name', 'like', "%{$search}%");
            }

            if ($multipleSelect) {
                $skills = $skillsQuery->get();
            } else {
                $skills = $skillsQuery->paginate(12, ['*'], 'page_skills')->withQueryString();
            }
        }

        // -- Summary Stats --
        $totalTrashedProjects = Project::onlyTrashed()->count();
        $totalTrashedSkills = Skill::onlyTrashed()->count();
        $totalTrashed = $totalTrashedProjects + $totalTrashedSkills;

        $expiringSoon = Project::onlyTrashed()->get()->filter(function($p){
            $deleteAt = $p->deleted_at->copy()->addDays(config('app.trash_retention_days'));
            return now()->diffInDays($deleteAt, false) <= 5
                && now()->diffInDays($deleteAt, false) > 0;
        })->count();

        $data = compact(
            'groupedProjects', 
            'skills', 
            'tab', 
            'sort', 
            'search', 
            'multipleSelect', 
            'totalTrashed', 
            'expiringSoon',
            'totalTrashedProjects',
            'totalTrashedSkills'
        );

        if ($request->ajax()) {
            return view('dashboard.trash.partials.content', $data);
        }

        return view('dashboard.trash', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | SKILL TRASH METHODS
    |--------------------------------------------------------------------------
    */
    public function restoreSkill($id)
    {
        $skill = Skill::onlyTrashed()->findOrFail($id);
        $skill->restore();

        return redirect()->back()->with('success', 'Skill successfully restored!');
    }

    public function forceDeleteSkill($id)
    {
        $skill = Skill::onlyTrashed()->findOrFail($id);
        $skill->forceDelete();

        return redirect()->back()->with('success', 'Skill permanently deleted!');
    }

    public function bulkRestoreSkills(Request $request)
    {
        Skill::onlyTrashed()
            ->whereIn('id', $request->skills ?? [])
            ->restore();

        return back()->with('success', 'Selected skills successfully restored.');
    }

    public function bulkForceDeleteSkills(Request $request)
    {
        Skill::onlyTrashed()
            ->whereIn('id', $request->skills ?? [])
            ->forceDelete();

        return back()->with('success', 'Selected skills permanently deleted.');
    }
}
