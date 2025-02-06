<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Carbon\Carbon;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('start_date')
                    ->orWhere('start_date', '<=', Carbon::now());
            })
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', Carbon::now());
            })
            ->get();

        return response()->json($announcements);
    }
}
