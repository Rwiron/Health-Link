<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class SuperadminAnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderBy('start_date', 'desc')->get();
        return view('superadmin.announcements.index', compact('announcements'));
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

        Toastr::success('Announcement created successfully.', 'Success');
        return redirect()->route('superadmin.announcements.index');
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

        Toastr::success('Announcement updated successfully.', 'Success');
        return redirect()->route('superadmin.announcements.index');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        Toastr::success('Announcement deleted successfully.', 'Success');
        return redirect()->route('superadmin.announcements.index');
    }
}