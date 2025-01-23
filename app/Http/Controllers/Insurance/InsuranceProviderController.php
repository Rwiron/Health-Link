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
    public function index()
    {
        $insuranceProviders = InsuranceProvider::with('hospitals')->get();
        $hospitals = Hospital::all();
        return view('insurance.index', compact('insuranceProviders', 'hospitals'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:insurance_providers,name',
                'hospital_ids' => 'required|array',
                'hospital_ids.*' => 'exists:hospitals,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = $request->only(['name']);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('insurance_images', 'public');
                $data['image'] = $path;
            }

            $insuranceProvider = InsuranceProvider::create($data);
            $insuranceProvider->hospitals()->sync($request->hospital_ids);

            Toastr::success('Insurance provider added successfully.', 'Success');
            return redirect()->route('insurance.index');
        } catch (\Exception $e) {
            Log::error('Error adding insurance provider: ' . $e->getMessage());
            Toastr::error('An error occurred while adding the insurance provider.', 'Error');
            return redirect()->route('insurance.index');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:insurance_providers,name,' . $id,
                'hospital_ids' => 'required|array',
                'hospital_ids.*' => 'exists:hospitals,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $insuranceProvider = InsuranceProvider::findOrFail($id);
            $data = $request->only(['name']);

            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('insurance_images', 'public');
                $data['image'] = $path;

                // Delete old image if exists
                if ($insuranceProvider->image && Storage::disk('public')->exists($insuranceProvider->image)) {
                    Storage::disk('public')->delete($insuranceProvider->image);
                }
            }

            $insuranceProvider->update($data);

            // Update pivot table for hospitals
            $insuranceProvider->hospitals()->sync($request->hospital_ids);

            Toastr::success('Insurance provider updated successfully.', 'Success');
            return redirect()->route('insurance.index');
        } catch (\Exception $e) {
            Log::error('Error updating insurance provider: ' . $e->getMessage());
            Toastr::error('An error occurred while updating the insurance provider.', 'Error');
            return redirect()->route('insurance.index');
        }
    }



    public function destroy($id)
    {
        try {
            $insuranceProvider = InsuranceProvider::findOrFail($id);

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
