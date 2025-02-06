<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Carbon\Carbon;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderBy('start_date', 'desc')->get();
        return view('superadmin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('superadmin.announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean'
        ]);

        Announcement::create($request->all());

        return redirect()->route('superadmin.announcements.index')->with('success', 'Announcement created successfully.');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('superadmin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean'
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->update($request->all());

        return redirect()->route('superadmin.announcements.index')->with('success', 'Announcement updated successfully.');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()->route('superadmin.announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}