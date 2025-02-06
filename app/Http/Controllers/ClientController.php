<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $organizationType = $request->input('organization_type');

        // Fetch hospitals based on selected organization type
        $query = Hospital::query();

        if ($organizationType && $organizationType !== 'All') {
            $query->where('organization_type', $organizationType);
        }

        $hospitals = $query->get();

        return view('client.index', compact('hospitals', 'organizationType'));
    }
}
