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



    public function search1(Request $request)
    {
        $query = Hospital::query();

        // Filter by province
        if ($request->has('province') && $request->province) {
            $query->where('province', $request->province);
        }

        // Filter by district
        if ($request->has('district') && $request->district) {
            $query->where('district', $request->district);
        }

        // Filter by partial service name or category
        if ($request->has('service') && $request->service) {
            $query->whereHas('services', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->service . '%')
                    ->orWhere('category', 'like', '%' . $request->service . '%');
            });
        }

        $hospitals = $query->get();

        return response()->json([
            'status' => 'success',
            'data' => $hospitals,
        ]);
    }


    public function search(Request $request)
    {
        $query = Hospital::query();

        // Filter by province
        if ($request->has('province') && $request->province) {
            $query->where('province', $request->province);
        }

        // Filter by district
        if ($request->has('district') && $request->district) {
            $query->where('district', $request->district);
        }

        // Filter by partial service name or category
        if ($request->has('service') && $request->service) {
            $query->whereHas('services', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->service . '%')
                    ->orWhere('category', 'like', '%' . $request->service . '%');
            });
        }

        $hospitals = $query->with('services')->get(); // Eager load services

        return response()->json([
            'status' => 'success',
            'data' => $hospitals->map(function ($hospital) {
                return [
                    'id' => $hospital->id,
                    'name' => $hospital->name,
                    'address' => $hospital->address,
                    'services' => $hospital->services->map(function ($service) {
                        return $service->name;
                    })->toArray()
                ];
            }),
        ]);
    }





    public function show($id)
    {
        $hospital = Hospital::with([
            'services',
            'doctors',
            'insuranceProviders', // Use the correct relationship
        ])->findOrFail($id);

        return view('client.hospital-detail', compact('hospital'));
    }
}
