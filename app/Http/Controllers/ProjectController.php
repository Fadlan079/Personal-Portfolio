<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Technology;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('type') && $request->type !== 'all') {
            $query->filterType($request->type);
        }

        $isFirstPage = ($request->get('page', 1) == 1);

        $projects = $query
            ->latest()
            ->paginate($isFirstPage ? 2 : 3)
            ->withQueryString();

        $summary = Project::summary();

        $technologies = Technology::pluck('name');

        return view('dashboard.project', compact(
            'projects',
            'summary',
            'technologies'
        ));
    }

    public function create()
    {
        $technologies = Technology::pluck('name');
        return view('project.create', compact('technologies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required',
            'desc' => 'required',
            'status' => 'required',
            'role' => 'nullable|string',
            'team_size' => 'nullable|integer',
            'responsibilities' => 'nullable|string',
            'tech' => 'nullable|string',
            'repo' => 'nullable|url',
            'live_url' => 'nullable|url',
            'screenshot.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['tech'] = $request->tech
            ? json_decode($request->tech, true)
            : [];
        $screenshotPaths = [];

        if ($request->hasFile('screenshot')) {
            foreach ($request->file('screenshot') as $file) {
                $path = $file->store('projects', 'public');
                $screenshotPaths[] = $path;
            }
        }

        $techs = $validated['tech'] ?? [];

        foreach ($techs as $tech) {
            Technology::firstOrCreate([
                'name' => strtolower($tech)
            ]);
        }

        $validated['screenshot'] = $screenshotPaths;


        Project::create($validated);

        return back()->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $project->update($validated);

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project deleted!');
    }

    public function trash(Request $request)
    {
        $sort = $request->get('sort', 'desc');
        $search = $request->get('search');

        $monthsQuery = Project::onlyTrashed();
       $multipleSelect = $request->get('multiple_select', 0);

        if ($search) {
            $monthsQuery->where('title', 'like', "%{$search}%");
        }

        $months = $monthsQuery
            ->selectRaw("DATE_FORMAT(deleted_at, '%Y-%m') as month")
            ->distinct()
            ->orderBy('month', $sort)
            ->pluck('month');

        $groupedProjects = [];

        foreach ($months as $month) {
            $query = Project::onlyTrashed()
                ->whereRaw("DATE_FORMAT(deleted_at, '%Y-%m') = ?", [$month])
                ->orderBy('deleted_at', $sort);

            if ($search) {
                $query->where('title', 'like', "%{$search}%");
            }

            // Gunakan multipleSelect untuk ambil semua data tanpa pagination
            if ($multipleSelect) {
                $projects = $query->get();
            } else {
                $projects = $query->paginate(3, ['*'], "page_$month")->withQueryString();
            }

            $formattedMonth = \Carbon\Carbon::createFromFormat('Y-m', $month)
                ->format('F Y');

            $groupedProjects[$formattedMonth] = $projects;
        }

        $totalTrashed = Project::onlyTrashed()->count();

        $expiringSoon = Project::onlyTrashed()->get()->filter(function($p){
            $deleteAt = $p->deleted_at->copy()->addDays(config('app.trash_retention_days'));
            return now()->diffInDays($deleteAt, false) <= 5
                && now()->diffInDays($deleteAt, false) > 0;
        })->count();

        return view('dashboard.trash', compact(
            'groupedProjects',
            'sort',
            'totalTrashed',
            'expiringSoon',
            'search',
            'multipleSelect'
        ));
    }

    public function bulkRestore(Request $request)
    {
        Project::onlyTrashed()
            ->whereIn('id', $request->projects)
            ->restore();

        return back()->with('success', 'Projects restored.');
    }

    public function bulkForceDelete(Request $request)
    {
        Project::onlyTrashed()
            ->whereIn('id', $request->projects)
            ->forceDelete();

        return back()->with('success', 'Projects permanently deleted.');
    }

    public function restore($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->back()->with('success', 'Project berhasil direstore!');
    }

    public function forceDelete($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->forceDelete();

        return redirect()->back()->with('success', 'Project dihapus permanen!');
    }
}
