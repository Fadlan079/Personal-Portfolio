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
        $tab = $request->get('tab', 'all'); // 'all', 'projects', 'skills', 'achievements', 'contacts'
        $sort = $request->get('sort', 'latest');
        $direction = $sort === 'oldest' ? 'asc' : 'desc';
        $search = $request->get('search');
        $multipleSelect = $request->get('multiple_select', 0) || $request->get('bulk_mode', 0);

        // -- Projects Fetching --
        $groupedProjects = collect();
        if (in_array($tab, ['all', 'projects'])) {
            $projectsQuery = Project::onlyTrashed();
            if ($search) $projectsQuery->where('title', 'like', "%{$search}%");
            
            $months = $projectsQuery->clone()->selectRaw("DATE_FORMAT(deleted_at, '%Y-%m') as month")->distinct()->orderBy('month', $direction)->pluck('month');
            foreach ($months as $month) {
                $query = Project::onlyTrashed()->whereRaw("DATE_FORMAT(deleted_at, '%Y-%m') = ?", [$month])->orderBy('deleted_at', $direction);
                if ($search) $query->where('title', 'like', "%{$search}%");
                $groupedProjects->put(\Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y'), $multipleSelect ? $query->get() : $query->paginate(3, ['*'], "page_projects_$month")->withQueryString());
            }
        }

        // -- Skills Fetching --
        $groupedSkills = collect();
        if (in_array($tab, ['all', 'skills'])) {
            $skillsQuery = Skill::onlyTrashed();
            if ($search) $skillsQuery->where('name', 'like', "%{$search}%");
            
            $months = $skillsQuery->clone()->selectRaw("DATE_FORMAT(deleted_at, '%Y-%m') as month")->distinct()->orderBy('month', $direction)->pluck('month');
            foreach ($months as $month) {
                $query = Skill::onlyTrashed()->whereRaw("DATE_FORMAT(deleted_at, '%Y-%m') = ?", [$month])->orderBy('deleted_at', $direction);
                if ($search) $query->where('name', 'like', "%{$search}%");
                $groupedSkills->put(\Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y'), $multipleSelect ? $query->get() : $query->paginate(6, ['*'], "page_skills_$month")->withQueryString());
            }
        }

        // -- Achievements Fetching --
        $groupedAchievements = collect();
        if (in_array($tab, ['all', 'achievements'])) {
            $achievementsQuery = \App\Models\Achievement::onlyTrashed();
            if ($search) $achievementsQuery->where('title', 'like', "%{$search}%");
            
            $months = $achievementsQuery->clone()->selectRaw("DATE_FORMAT(deleted_at, '%Y-%m') as month")->distinct()->orderBy('month', $direction)->pluck('month');
            foreach ($months as $month) {
                $query = \App\Models\Achievement::onlyTrashed()->whereRaw("DATE_FORMAT(deleted_at, '%Y-%m') = ?", [$month])->orderBy('deleted_at', $direction);
                if ($search) $query->where('title', 'like', "%{$search}%");
                $groupedAchievements->put(\Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y'), $multipleSelect ? $query->get() : $query->paginate(6, ['*'], "page_achievements_$month")->withQueryString());
            }
        }

        // -- Contacts Fetching --
        $groupedContacts = collect();
        if (in_array($tab, ['all', 'contacts'])) {
            $contactsQuery = \App\Models\Contact::onlyTrashed();
            if ($search) $contactsQuery->where('sender', 'like', "%{$search}%")->orWhere('subject', 'like', "%{$search}%");
            
            $months = $contactsQuery->clone()->selectRaw("DATE_FORMAT(deleted_at, '%Y-%m') as month")->distinct()->orderBy('month', $direction)->pluck('month');
            foreach ($months as $month) {
                $query = \App\Models\Contact::onlyTrashed()->whereRaw("DATE_FORMAT(deleted_at, '%Y-%m') = ?", [$month])->orderBy('deleted_at', $direction);
                if ($search) $query->where(fn($q) => $q->where('sender', 'like', "%{$search}%")->orWhere('subject', 'like', "%{$search}%"));
                $groupedContacts->put(\Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y'), $multipleSelect ? $query->get() : $query->paginate(5, ['*'], "page_contacts_$month")->withQueryString());
            }
        }

        // -- Summary Stats --
        $totalTrashedProjects = Project::onlyTrashed()->count();
        $totalTrashedSkills = Skill::onlyTrashed()->count();
        $totalTrashedAchievements = \App\Models\Achievement::onlyTrashed()->count();
        $totalTrashedContacts = \App\Models\Contact::onlyTrashed()->count();
        $totalTrashed = $totalTrashedProjects + $totalTrashedSkills + $totalTrashedAchievements + $totalTrashedContacts;

        $expiringSoon = (Project::onlyTrashed()->count() + Skill::onlyTrashed()->count() + \App\Models\Achievement::onlyTrashed()->count() + \App\Models\Contact::onlyTrashed()->count());

        $data = compact(
            'groupedProjects', 'groupedSkills', 'groupedAchievements', 'groupedContacts',
            'tab', 'sort', 'search', 'multipleSelect', 'totalTrashed', 'expiringSoon',
            'totalTrashedProjects', 'totalTrashedSkills', 'totalTrashedAchievements', 'totalTrashedContacts'
        );

        if ($request->ajax()) return view('dashboard.trash.partials.content', $data);
        return view('dashboard.trash', $data);
    }

    /** ACHIEVEMENT TRASH METHODS **/
    public function restoreAchievement($id) {
        \App\Models\Achievement::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Pencapaian berhasil dipulihkan.');
    }

    public function forceDeleteAchievement($id) {
        $ach = \App\Models\Achievement::onlyTrashed()->findOrFail($id);
        if ($ach->image_url) \Illuminate\Support\Facades\Storage::disk('public')->delete($ach->image_url);
        $ach->forceDelete();
        return back()->with('success', 'Pencapaian dihapus permanen.');
    }

    public function bulkRestoreAchievements(Request $request) {
        \App\Models\Achievement::onlyTrashed()->whereIn('id', $request->achievements ?? [])->restore();
        return back()->with('success', 'Pencapaian terpilih berhasil dipulihkan.');
    }

    public function bulkForceDeleteAchievements(Request $request) {
        $achievements = \App\Models\Achievement::onlyTrashed()->whereIn('id', $request->achievements ?? [])->get();
        foreach ($achievements as $ach) {
            if ($ach->image_url) \Illuminate\Support\Facades\Storage::disk('public')->delete($ach->image_url);
            $ach->forceDelete();
        }
        return back()->with('success', 'Pencapaian terpilih dihapus permanen.');
    }

    /** CONTACT TRASH METHODS **/
    public function restoreContact($id) {
        \App\Models\Contact::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Pesan berhasil dipulihkan.');
    }

    public function forceDeleteContact($id) {
        \App\Models\Contact::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'Pesan dihapus permanen.');
    }

    public function bulkRestoreContacts(Request $request) {
        \App\Models\Contact::onlyTrashed()->whereIn('id', $request->contacts ?? [])->restore();
        return back()->with('success', 'Pesan terpilih berhasil dipulihkan.');
    }

    public function bulkForceDeleteContacts(Request $request) {
        \App\Models\Contact::onlyTrashed()->whereIn('id', $request->contacts ?? [])->forceDelete();
        return back()->with('success', 'Pesan terpilih dihapus permanen.');
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
