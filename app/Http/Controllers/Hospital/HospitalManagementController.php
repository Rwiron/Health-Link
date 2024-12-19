<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;

class HospitalManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::all(); // Fetch all hospitals
        return view('hospital.index', compact('hospitals'));
    }

    /**
     * Store a newly created hospital in storage.
     */
    public function store(Request $request, $id)
    {
        try {
            $request->validate([

                'name' => 'required|max:255|unique:hospitals,name,' . $id,
                'address' => 'required|max:500|string',
                'phone' => 'required|regex:/^\+?[0-9\s\-()]{7,15}$/',
                'organization_type' => 'required|in:Private,Public,Mixture',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'location' => 'nullable|string|max:500',
            ]);

            $data = $request->all();

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $path = $file->store('logos', 'public');
                $data['logo'] = $path;
            }

            Hospital::create($data);

            Toastr::success('Hospital added successfully.', 'Success');
            return redirect()->route('hospital.index');
        } catch (\Exception $e) {
            Log::error('Error adding hospital: ' . $e->getMessage());
            Toastr::error('An error occurred while adding the hospital.', 'Error');
            return redirect()->route('hospital.index');
        }
    }


    /**
     * Update the specified hospital in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|max:255|unique:hospitals,name,' . $id, // Exclude current record
                'address' => 'required|max:500',
                'phone' => 'required|regex:/^\+?[0-9\s\-()]{7,15}$/',
                'organization_type' => 'required|in:Private,Public,Mixture',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
            ]);

            $hospital = Hospital::findOrFail($id);
            $data = $request->all();

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $path = $file->store('logos', 'public');
                $data['logo'] = $path;

                // Delete old logo if it exists
                if ($hospital->logo && \Storage::disk('public')->exists($hospital->logo)) {
                    \Storage::disk('public')->delete($hospital->logo);
                }
            }

            $hospital->update($data);

            Toastr::success('Hospital updated successfully.', 'Success');
            return redirect()->route('hospital.index');
        } catch (\Exception $e) {
            Log::error('Error updating hospital: ' . $e->getMessage());
            Toastr::error('An error occurred while updating the hospital.', 'Error');
            return redirect()->route('hospital.index');
        }
    }



    /**
     * Remove the specified hospital from storage.
     */
    public function destroy($id)
    {
        try {
            $hospital = Hospital::findOrFail($id);
            $hospital->delete();

            Toastr::success('Hospital deleted successfully.', 'Success');
            return redirect()->route('hospital.index');
        } catch (\Exception $e) {
            Log::error('Error deleting hospital: ' . $e->getMessage());
            Toastr::error('An error occurred while deleting the hospital.', 'Error');
            return redirect()->route('hospital.index');
        }
    }
}
