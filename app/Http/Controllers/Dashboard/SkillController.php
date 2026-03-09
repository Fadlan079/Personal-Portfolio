<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Skill::query()->withCount('projects');

        // 1. Filter by category
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // 2. Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 3. Sort
        $sort = $request->get('sort', 'latest');
        if ($sort === 'most_projects') {
            $query->orderByDesc('projects_count');
        } elseif ($sort === 'least_projects') {
            $query->orderBy('projects_count');
        } elseif ($sort === 'az') {
            $query->orderBy('name', 'asc');
        } elseif ($sort === 'za') {
            $query->orderBy('name', 'desc');
        } else {
            $query->latest();
        }

        $skills = $query->paginate(12);

        if ($request->ajax()) {
            return view('dashboard.skills.partials.tags', compact('skills'));
        }

        $summary = \App\Models\Skill::summary();

        // ==========================================
        // DATA VISUALIZATION MATRIX (CHART.JS)
        // ==========================================

        // 1. Skills by Category
        $categoryChart = \App\Models\Skill::selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();

        // 2. Skills Growth per Year
        $growthChart = \App\Models\Skill::selectRaw('YEAR(created_at) as year, count(*) as count')
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->pluck('count', 'year')
            ->toArray();

        // 3. Skills with Icon (Integrity Check)
        $iconCount = \App\Models\Skill::whereNotNull('icon')->where('icon', '!=', '')->count();
        $noIconCount = \App\Models\Skill::whereNull('icon')->orWhere('icon', '')->count();

        // 4. Skills with Description (Payload Check)
        // *Pastikan kamu punya kolom 'description' di tabel skills. Jika namanya berbeda, silakan disesuaikan.*
        $descCount = \App\Models\Skill::whereNotNull('description')->where('description', '!=', '')->count();
        $noDescCount = \App\Models\Skill::whereNull('description')->orWhere('description', '')->count();

        $chartData = [
            'category' => $categoryChart,
            'growth'   => $growthChart,
            'icon'     => ['Valid Icon' => $iconCount, 'No Icon' => $noIconCount],
            'desc'     => ['Valid Desc' => $descCount, 'No Desc' => $noDescCount],
        ];

        return view('dashboard.skills.index', compact('skills', 'summary', 'chartData'));
    }

    public function create()
    {
        return view('dashboard.skills.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:skills',
            'category' => 'required|in:frontend,backend,tools',
            'icon' => 'nullable|string',
            'description' => 'nullable|string',
            'is_core' => 'nullable|boolean'
        ]);

        $validated['is_core'] = $request->boolean('is_core');

        \App\Models\Skill::create($validated);
        return redirect()->route('dashboard.skills.index')->with('success', 'Skill created successfully.');
    }

    public function show(string $id)
    {
        // Not used
    }

    public function edit(string $id)
    {
        $skill = \App\Models\Skill::findOrFail($id);
        return view('dashboard.skills.edit', compact('skill'));
    }

    public function update(Request $request, string $id)
    {
        $skill = \App\Models\Skill::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:skills,name,' . $skill->id,
            'category' => 'required|in:frontend,backend,tools',
            'icon' => 'nullable|string',
            'description' => 'nullable|string',
            'is_core' => 'nullable|boolean'
        ]);

        $validated['is_core'] = $request->boolean('is_core');

        $skill->update($validated);
        return redirect()->route('dashboard.skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(string $id)
    {
        $skill = \App\Models\Skill::findOrFail($id);
        $skill->delete();
        return redirect()->route('dashboard.skills.index')->with('success', 'Skill deleted successfully.');
    }
}
