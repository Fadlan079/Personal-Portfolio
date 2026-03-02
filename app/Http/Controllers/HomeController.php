<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $recentProjects = Project::recent(5)->get();
        // Only fetch skills that have at least 1 associated project (unlocked)
        $skills = \App\Models\Skill::has('projects')->withCount('projects')->get();
        return view('pages.home', compact('recentProjects', 'skills'));
    }

    public function Showabout(){
        return view('pages.about');
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

        $projects = $query->latest()->paginate(6)->withQueryString();
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

    public function Showcontact(){
        return view('pages.contact');
    }
}
