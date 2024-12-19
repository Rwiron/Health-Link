<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;

class DesignerController extends Controller
{
    public function dashboard()
    {
        return view('designer.dashboard');
    }
}