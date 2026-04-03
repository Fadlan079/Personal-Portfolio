<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    public function index(Request $request)
    {
        $query = Achievement::query()->withCount('projects');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('issuer', 'like', '%' . $request->search . '%');
        }

        $sort = $request->get('sort', 'latest');
        if ($sort === 'most_projects') {
            $query->orderByDesc('projects_count');
        } elseif ($sort === 'oldest') {
            $query->orderBy('date', 'asc');
        } else {
            $query->orderBy('date', 'desc');
        }

        $achievements = $query->paginate(6);

        $summary = [
            'total' => Achievement::count(),
            'total_issuers' => Achievement::distinct('issuer')->count('issuer'),
        ];

        return view('dashboard.achievements.index', compact('achievements', 'summary'));
    }

    public function create()
    {
        return view('dashboard.achievements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:10240', // 10MB max
        ]);

        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('achievements', 'public');
        }

        Achievement::create($validated);

        return redirect()->route('dashboard.achievements.index')->with('success', 'Pencapaian berhasil ditambahkan.');
    }

    public function edit(Achievement $achievement)
    {
        return view('dashboard.achievements.edit', compact('achievement'));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:10240',
        ]);

        if ($request->hasFile('image')) {
            if ($achievement->image_url) {
                Storage::disk('public')->delete($achievement->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('achievements', 'public');
        }

        $achievement->update($validated);

        return redirect()->route('dashboard.achievements.index')->with('success', 'Pencapaian berhasil diperbarui.');
    }

    public function destroy(Achievement $achievement)
    {
        if ($achievement->image_url) {
            Storage::disk('public')->delete($achievement->image_url);
        }
        $achievement->delete();

        return redirect()->route('dashboard.achievements.index')->with('success', 'Pencapaian berhasil dihapus.');
    }
}
