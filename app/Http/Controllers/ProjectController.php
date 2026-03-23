<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;

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

        $sort = $request->get('sort', 'latest');
        $direction = $sort === 'oldest' ? 'asc' : 'desc';
        $query->orderBy('created_at', $direction);

        $multipleSelect = $request->get('multiple_select', 0);

        if ($multipleSelect) {
            $projects = $query->get();
        } else {
            $projects = $query->paginate(3)->withQueryString();
        }

        $summary = Project::summary();
        $technologies = \App\Models\Skill::pluck('name');

        $typesChart = Project::selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        $soloCount = Project::whereIn('team_size', ['Solo', '1'])->count();
        $totalWithTeam = Project::whereNotNull('team_size')->where('team_size', '!=', '')->count();
        $teamChart = [
            'Solo' => $soloCount,
            'Team' => $totalWithTeam - $soloCount
        ];

        // 3. Productivity Timeline (Last 6 Months)
        $timelineChart = [];
        // Setup array 6 bulan terakhir dengan nilai awal 0
        for ($i = 5; $i >= 0; $i--) {
            $monthName = now()->subMonths($i)->format('M'); // Contoh: Oct, Nov, Dec
            $timelineChart[$monthName] = 0;
        }

        // Ambil data project 6 bulan terakhir
        $recentProjects = Project::where('created_at', '>=', now()->subMonths(5)->startOfMonth())->get(['created_at']);

        // Kelompokkan dan hitung berdasarkan bulan (menggunakan collection agar aman di semua DB)
        $timelineData = $recentProjects->groupBy(function($item) {
            return $item->created_at->format('M');
        })->map(function ($row) {
            return $row->count();
        })->toArray();

        // Gabungkan data agar bulan yang kosong (0) tetap tampil di chart
        $timelineChart = array_merge($timelineChart, $timelineData);

        // Gabungkan ke dalam satu array matrix
        $chartData = [
            'types'    => $typesChart,
            'team'     => $teamChart,
            'timeline' => $timelineChart,
        ];

        $translations = json_decode(file_get_contents(resource_path('lang/id.json')), true);
        $projectPlaceholders = $translations['project']['search']['placeholder'];

        return view('dashboard.project', compact(
            'projects',
            'summary',
            'technologies',
            'multipleSelect',
            'chartData', // <- Passing datanya ke Blade
            'projectPlaceholders'
        ));
    }

    public function create()
    {
        $technologies = \App\Models\Skill::pluck('name');
        return view('project.create', compact('technologies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'desc' => 'required|string',
            'status' => 'required|string',

            'visibility' => 'required|in:draft,scheduled,published',

            'published_at' => 'nullable|date|required_if:visibility,scheduled',

            'role' => 'nullable|string',
            'team_size' => 'nullable|integer',
            'responsibilities' => 'nullable|string',
            'tech' => 'nullable|string',
            'repo' => 'nullable|url',
            'live_url' => 'nullable|url',
            'screenshot' => 'array|max:8',
            'screenshot.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'image_desktop' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'image_tablet' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'image_mobile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($validated['visibility'] === 'published') {
            $validated['published_at'] = now();
        }

        if ($validated['visibility'] === 'draft') {
            $validated['published_at'] = null;
        }

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

        $validSkills = \App\Models\Skill::whereIn('name', $techs)->get();

        // Update the tech JSON column to only include valid skills
        $validated['tech'] = $validSkills->pluck('name')->toArray();

        $validated['screenshot'] = $screenshotPaths;

        if ($request->hasFile('image_desktop')) {
            $validated['image_desktop'] = $request->file('image_desktop')->store('projects', 'public');
        }
        if ($request->hasFile('image_tablet')) {
            $validated['image_tablet'] = $request->file('image_tablet')->store('projects', 'public');
        }
        if ($request->hasFile('image_mobile')) {
            $validated['image_mobile'] = $request->file('image_mobile')->store('projects', 'public');
        }

        $project = Project::create($validated);

        // Sync relations
        $project->skills()->sync($validSkills->pluck('id'));

        return back()->with('success', 'Project created successfully.');
    }

    public function bulkDelete(Request $request)
    {
        Project::whereIn('id', $request->projects)->delete();
        return back()->with('success', 'Selected projects deleted.');
    }

    public function bulkPublish(Request $request)
    {
        Project::whereIn('id', $request->projects)
            ->update(['visibility' => 'published', 'published_at' => now()]);
        return back()->with('success', 'Selected projects published.');
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:Website,Web App,Application,Design',
            'status' => 'required|in:Shipped,In Progress,Prototype,Archived',
            'desc' => 'required|string',
            'role' => 'nullable|string|max:255',
            'team_size' => 'nullable|integer',
            'responsibilities' => 'nullable|string',
            'visibility' => 'required|string',
            'repo' => 'nullable|string|max:255',
            'live_url' => 'nullable|string|max:255',
            'tech' => 'nullable|string',
            'image_desktop' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'image_tablet' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'image_mobile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $validated['tech'] = $request->tech
            ? json_decode($request->tech, true)
            : [];

        $techs = $validated['tech'] ?? [];

        $validSkills = \App\Models\Skill::whereIn('name', $techs)->get();

        // Update the tech JSON column to only include valid skills (matching DB names)
        $validated['tech'] = $validSkills->pluck('name')->toArray();

        if ($request->hasFile('image_desktop')) {
            if ($project->image_desktop) {
                Storage::disk('public')->delete($project->image_desktop);
            }
            $validated['image_desktop'] = $request->file('image_desktop')->store('projects', 'public');
        }
        if ($request->hasFile('image_tablet')) {
            if ($project->image_tablet) {
                Storage::disk('public')->delete($project->image_tablet);
            }
            $validated['image_tablet'] = $request->file('image_tablet')->store('projects', 'public');
        }
        if ($request->hasFile('image_mobile')) {
            if ($project->image_mobile) {
                Storage::disk('public')->delete($project->image_mobile);
            }
            $validated['image_mobile'] = $request->file('image_mobile')->store('projects', 'public');
        }

        $project->update($validated);

        // Sync relations for Many-to-Many
        $project->skills()->sync($validSkills->pluck('id'));

        /*
        |--------------------------------------------------------------------------
        | HANDLE SCREENSHOT JSON
        |--------------------------------------------------------------------------
        */

        $existingScreenshots = $project->screenshot ?? [];
        $existingScreenshots = is_array($existingScreenshots)
            ? $existingScreenshots
            : json_decode($existingScreenshots, true) ?? [];

        /*
        | Hapus screenshot lama
        */
        if ($request->deleted_screenshots) {
            foreach ($request->deleted_screenshots as $deletedPath) {

                // hapus file dari storage
                Storage::disk('public')->delete($deletedPath);

                // hapus dari array
                $existingScreenshots = array_filter(
                    $existingScreenshots,
                    fn($path) => $path !== $deletedPath
                );
            }
        }

        /*
        | Upload screenshot baru
        */
        if ($request->hasFile('new_screenshot')) {

            foreach ($request->file('new_screenshot') as $file) {

                $path = $file->store('projects', 'public');
                $existingScreenshots[] = $path;
            }
        }

        /*
        | Batasi max 8 gambar
        */
        $existingScreenshots = array_slice($existingScreenshots, 0, 8);

        /*
        | Save kembali ke JSON column
        */
        $project->update([
            'screenshot' => array_values($existingScreenshots)
        ]);

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project updated successfully!');
    }
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Project permanently deleted!');
    }

    public function trash(Request $request)
    {
        $sort = $request->get('sort', 'latest');
        $direction = $sort === 'oldest' ? 'asc' : 'desc';
        $search = $request->get('search');

        $monthsQuery = Project::onlyTrashed();
        $multipleSelect = $request->get('multiple_select', 0);

        if ($search) {
            $monthsQuery->where('title', 'like', "%{$search}%");
        }

        $months = $monthsQuery
            ->selectRaw("DATE_FORMAT(deleted_at, '%Y-%m') as month")
            ->distinct()
            ->orderBy('month', $direction)
            ->pluck('month');

        $groupedProjects = [];

        foreach ($months as $month) {
            $query = Project::onlyTrashed()
                ->whereRaw("DATE_FORMAT(deleted_at, '%Y-%m') = ?", [$month])
                ->orderBy('deleted_at', $direction);

            if ($search) {
                $query->where('title', 'like', "%{$search}%");
            }

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

        $expiringSoon = Project::onlyTrashed()->get()->filter(function ($p) {
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

        return back()->with('success', 'Projects successfully restored.');
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

        return redirect()->back()->with('success', 'Project successfully restored!');
    }

    public function forceDelete($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->forceDelete();

        return redirect()->back()->with('success', 'Project permanently deleted!');
    }
}
