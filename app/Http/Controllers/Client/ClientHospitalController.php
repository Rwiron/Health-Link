<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;

class ClientHospitalController extends Controller
{
    public function index()
    {
        return view('client.search-hospital');
    }

    public function search(Request $request)
    {
        $query = Hospital::query();

        if ($request->has('province') && $request->province) {
            $query->where('province', $request->province);
        }

        if ($request->has('district') && $request->district) {
            $query->where('district', $request->district);
        }

        $hospitals = $query->get();

        return response()->json([
            'status' => 'success',
            'data' => $hospitals,
        ]);
    }

    public function show2($id)
    {
        $hospital = Hospital::with(['insurance', 'services', 'doctors'])->findOrFail($id);

        return view('client.hospital-detail', compact('hospital'));
    }

    public function show($id)
    {
        $hospital = Hospital::with(['insurance', 'services', 'doctors'])->findOrFail($id);
        return view('client.hospital-detail', compact('hospital'));
    }
}
