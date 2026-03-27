<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the Transmission Logs (Inbox).
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $filter = $request->get('filter', 'ALL'); // ALL, UNREAD, PROJECT, COLLAB

        $query = Contact::query();

        // 1. Search Query
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('sender', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // 2. Filter Dropdown
        if ($filter === 'UNREAD') {
            $query->where('is_read', false);
        } elseif ($filter === 'PROJECT') {
            $query->where('type', 'project');
        } elseif ($filter === 'COLLAB') {
            $query->where('type', 'collab');
        }

        // Group by month and paginate each month separately
        $months = $query->clone()
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month")
            ->distinct()
            ->orderBy('month', 'desc')
            ->pluck('month');

        $groupedContacts = collect();

        foreach ($months as $month) {
            $monthQuery = $query->clone();
            $contacts = $monthQuery
                ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$month])
                ->orderBy('created_at', 'desc')
                ->paginate(5, ['*'], "page_$month")->withQueryString();

            $formattedMonth = \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y');
            $groupedContacts->put($formattedMonth, $contacts);
        }

        // 3. System Metrics
        $totalMessages = Contact::count();
        $unreadCount = Contact::where('is_read', false)->count();
        $projectCount = Contact::where('type', 'project')->count();
        $collabCount = Contact::where('type', 'collab')->count();

        // ==========================================
        // 4. DATA VISUALIZATION MATRIX (CHART.JS)
        // ==========================================

        // 4.1 Contacts per Month (Last 6 Months)
        $timelineChart = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthName = now()->subMonths($i)->format('M');
            $timelineChart[$monthName] = 0;
        }
        $recentContacts = Contact::where('created_at', '>=', now()->subMonths(5)->startOfMonth())->get(['created_at']);
        $timelineData = $recentContacts->groupBy(function($item) {
            return $item->created_at->format('M');
        })->map->count()->toArray();
        $timelineChart = array_merge($timelineChart, $timelineData);

        // 4.3 Contact Type
        $typeChart = Contact::selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        $inboxChart = [
            'read' => $totalMessages - $unreadCount,
            'unread' => $unreadCount,
            'total' => $totalMessages,
        ];

        $chartData = [
            'timeline' => $timelineChart,
            'type'     => $typeChart,
            'inbox'    => $inboxChart,
        ];

        return view('dashboard.contact.contact', compact(
            'groupedContacts',
            'totalMessages',
            'unreadCount',
            'projectCount',
            'collabCount',
            'search',
            'filter',
            'chartData' // <-- Variable baru
        ));
    }

    /**
     * Mark a specific message as read.
     */
    public function markAsRead(Request $request, Contact $contact)
    {
        $contact->update(['is_read' => true]);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back();
    }

    /**
     * Mark all unread messages as read.
     */
    public function markAllAsRead()
    {
        Contact::where('is_read', false)->update(['is_read' => true]);

        return back()->with('success', 'All transmission logs marked as read.');
    }

    /**
     * Permanently delete a message.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return back()->with('success', 'Transmission log successfully purged.');
    }
}
