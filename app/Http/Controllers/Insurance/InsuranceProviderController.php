<?php

namespace App\Http\Controllers\Insurance;

use App\Http\Controllers\Controller;
use App\Models\InsuranceProvider;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class InsuranceProviderController extends Controller
{
    /**
     * Display a listing of insurance providers.
     */
    public function index()
    {
        $insuranceProviders = InsuranceProvider::with('hospital')->get();
        $hospitals = Hospital::all();
        return view('insurance.index', compact('insuranceProviders', 'hospitals'));
    }

    /**
     * Store a newly created insurance provider in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:insurance_providers,name',
                'hospital_id' => 'required|exists:hospitals,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = $request->all();

            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('insurance_images', 'public');
                $data['image'] = $path;
            }

            InsuranceProvider::create($data);

            Toastr::success('Insurance provider added successfully.', 'Success');
            return redirect()->route('insurance.index');
        } catch (\Exception $e) {
            Log::error('Error adding insurance provider: ' . $e->getMessage());
            Toastr::error('An error occurred while adding the insurance provider.', 'Error');
            return redirect()->route('insurance.index');
        }
    }

    /**
     * Update the specified insurance provider in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:insurance_providers,name,' . $id,
                'hospital_id' => 'required|exists:hospitals,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $insuranceProvider = InsuranceProvider::findOrFail($id);
            $data = $request->all();

            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('insurance_images', 'public');
                $data['image'] = $path;

                // Delete the old image if it exists
                if ($insuranceProvider->image && Storage::disk('public')->exists($insuranceProvider->image)) {
                    Storage::disk('public')->delete($insuranceProvider->image);
                }
            }

            $insuranceProvider->update($data);

            Toastr::success('Insurance provider updated successfully.', 'Success');
            return redirect()->route('insurance.index');
        } catch (\Exception $e) {
            Log::error('Error updating insurance provider: ' . $e->getMessage());
            Toastr::error('An error occurred while updating the insurance provider.', 'Error');
            return redirect()->route('insurance.index');
        }
    }

    /**
     * Remove the specified insurance provider from storage.
     */
    public function destroy($id)
    {
        try {
            $insuranceProvider = InsuranceProvider::findOrFail($id);

            // Delete the image if it exists
            if ($insuranceProvider->image && Storage::disk('public')->exists($insuranceProvider->image)) {
                Storage::disk('public')->delete($insuranceProvider->image);
            }

            $insuranceProvider->delete();

            Toastr::success('Insurance provider deleted successfully.', 'Success');
            return redirect()->route('insurance.index');
        } catch (\Exception $e) {
            Log::error('Error deleting insurance provider: ' . $e->getMessage());
            Toastr::error('An error occurred while deleting the insurance provider.', 'Error');
            return redirect()->route('insurance.index');
        }
    }
}
