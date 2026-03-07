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

        // Fetch paginated results, sorted by newest
        $contactsPaginator = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // Group by month visually (similar to what we did in Project/Trash)
        $groupedContacts = collect();
        foreach ($contactsPaginator->items() as $contact) {
            $month = $contact->created_at->format('F Y');
            if (!isset($groupedContacts[$month])) {
                $groupedContacts[$month] = collect();
            }
            $groupedContacts[$month]->push($contact);
        }

        // 3. System Metrics
        $totalMessages = Contact::count();
        $unreadCount = Contact::where('is_read', false)->count();
        $projectCount = Contact::where('type', 'project')->count();
        $collabCount = Contact::where('type', 'collab')->count();

        return view('dashboard.contact.contact', compact(
            'groupedContacts',
            'contactsPaginator',
            'totalMessages',
            'unreadCount',
            'projectCount',
            'collabCount',
            'search',
            'filter'
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
