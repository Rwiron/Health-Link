<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;

class SuperadminController extends Controller
{
    public function dashboard()
    {
        return view('superadmin.dashboard');
    }
}