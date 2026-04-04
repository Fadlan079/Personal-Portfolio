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
        return '';
    }

    public function index()
    {
        $recentProjects = Project::public()->recent(5)->withCount('achievements')->get();

        $achievements = \App\Models\Achievement::public()->withCount('projects')
        ->latest()
        ->paginate(3);

        if (request()->ajax()) {
            return view('themes.book.home.partials.achievements', compact('achievements'))->render();
        }

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

        return theme_view('home.home', compact(
            'recentProjects',
            'achievements',
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
        return theme_view('about', compact('profilePhoto'));
    }

    public function Showproject(Request $request)
    {
        $query = Project::public()->with('achievements');

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

        $translations = json_decode(file_get_contents(resource_path('lang/id.json')), true);
        $projectPlaceholders = $translations['project']['search']['placeholder'];

        if ($request->ajax() || $request->boolean('ajax')) {
            $layout = current_theme();
            $themeMap = [
                'diary'  => 'book',
                'clean'  => 'clean',
                'system' => 'system_architecture'
            ];
            $themeName = $themeMap[$layout] ?? 'book';

            return response()->json([
                'html'        => view("themes.{$themeName}.project.partials.project-list", compact('projects'))->render(),
                'pagination'  => view("themes.{$themeName}.project.partials.project-pagination", compact('projects'))->render(),
                'total'       => $projects->total(),
                'currentPage' => $projects->currentPage(),
                'lastPage'    => $projects->lastPage(),
            ]);
        }

        return theme_view('project.project', compact('projects', 'summary', 'projectPlaceholders'));
    }

    public function Showcontact()
    {
        $user = User::first();
        $waNumber = $user?->whatsapp ?? '';
        return theme_view('contact', compact('waNumber'));
    }

    public function Showsettings()
    {
        return theme_view('settings');
    }
}
