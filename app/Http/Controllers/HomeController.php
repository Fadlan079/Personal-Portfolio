<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class HomeController extends Controller
{
    private function profilePhotoUrl(): string
    {
        $user = User::first();
        if ($user && $user->profile_photo) {
            return asset('storage/' . $user->profile_photo);
        }
        return asset('profile.jpg');
    }

    public function index()
    {
        $recentProjects = Project::recent(5)->get();

        $skills = \App\Models\Skill::withCount('projects')
            ->where(function ($q) {
                $q->where('is_core', true)
                    ->orWhereHas('projects');
            })
            ->orderByDesc('projects_count')
            ->get();

        $profilePhoto = $this->profilePhotoUrl();

        $user = User::first();
        $setting = $user ? $user->setting : null;

        $showClock = $setting->show_clock ?? true;
        $clockFormat = $setting->clock_format ?? '24';
        $showSeconds = $setting->show_seconds ?? true;
        $showDate = $setting->show_date ?? true;

        $waRaw = $user?->whatsapp;
        $waLink = $waRaw
            ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $waRaw)
            : '#';

        $igRaw = $user?->instagram;
        $igLink = $igRaw
            ? (str_starts_with($igRaw, 'http')
                ? $igRaw
                : 'https://instagram.com/' . ltrim($igRaw, '@'))
            : '#';

        $ghRaw = $user?->github;
        $ghLink = $ghRaw
            ? (str_starts_with($ghRaw, 'http')
                ? $ghRaw
                : 'https://github.com/' . ltrim($ghRaw, '@'))
            : '#';

        $liRaw = $user?->linkedin;
        $liLink = $liRaw
            ? (str_starts_with($liRaw, 'http')
                ? $liRaw
                : 'https://linkedin.com/in/' . ltrim($liRaw, '@'))
            : '#';

        $emailLink = $user?->email
            ? 'mailto:' . $user->email
            : '#';

        return view('pages.Home.home', compact(
            'recentProjects',
            'skills',
            'profilePhoto',
            'showClock',
            'clockFormat',
            'showSeconds',
            'showDate',
            'waLink',
            'igLink',
            'ghLink',
            'liLink',
            'emailLink'
        ));
    }

    public function Showabout()
    {
        $profilePhoto = $this->profilePhotoUrl();
        return view('pages.about', compact('profilePhoto'));
    }

    public function Showproject(Request $request)
    {
        $query = Project::query();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('type') && $request->type !== 'all') {
            $query->filterType($request->type);
        }

        $sort = $request->input('sort', 'latest');
        $projects = $query->when($sort === 'oldest', fn($q) => $q->oldest(), fn($q) => $q->latest())
            ->paginate(6)->withQueryString();
        $summary  = Project::summary();

        // AJAX: return JSON with rendered HTML partials
        if ($request->ajax() || $request->boolean('ajax')) {
            return response()->json([
                'html'        => view('pages._projects-list', compact('projects'))->render(),
                'pagination'  => view('pages._projects-pagination', compact('projects'))->render(),
                'total'       => $projects->total(),
                'currentPage' => $projects->currentPage(),
                'lastPage'    => $projects->lastPage(),
            ]);
        }

        return view('pages.project', compact('projects', 'summary'));
    }

    public function Showcontact()
    {
        return view('pages.contact');
    }

    public function Showsettings()
    {
        return view('pages.settings');
    }
}
