<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('dashboard.settings');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'theme' => ['required', 'string', 'in:light,dark,system'],
            'language' => ['required', 'string', 'in:en,id'],
        ]);

        $user = $request->user();
        $user->update([
            'theme' => $validated['theme'],
            'locale' => $validated['language'],
        ]);

        return back()->with('success', 'Preferences saved successfully.');
    }
}
