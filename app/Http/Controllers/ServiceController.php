<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ServiceController extends Controller
{
   
    public function index()
    {
        $hospitals = Hospital::all(); // Fetch all hospitals
        $services = Service::all(); // Fetch all services
        return view('services.index', compact('hospitals', 'services'));
    }

    public function create()
    {
        $hospitals = Hospital::all(); // Fetch all hospitals for dropdown
        return view('services.create', compact('hospitals'));
    }

    public function store(Request $request)
    {
        try {
            // Normalize the status field
            $request->merge([
                'status' => $request->has('status') ? 1 : 0,
            ]);

            // Log incoming request
            \Log::info('Incoming Request:', $request->all());

            // Validate the request
            $request->validate([
                'hospital_id' => 'required|exists:hospitals,id',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'duration' => 'nullable|string|max:255',
                'category' => 'nullable|string|max:255',
                'status' => 'required|boolean',
            ]);

            // Save the service
            Service::create($request->all());

            Toastr::success('Service added successfully.', 'Success');
            return redirect()->route('services.index');
        } catch (\Exception $e) {
            // Log the exception
            \Log::error('Error saving service:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            Toastr::error('An error occurred while adding the service. Please try again.', 'Error');
            return redirect()->route('services.index')->withInput();
        }
    }



    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $hospitals = Hospital::all(); // Fetch hospitals for dropdown
        return view('services.edit', compact('service', 'hospitals'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $service->update($request->all());

        Toastr::success('Service updated successfully.', 'Success');
        return redirect()->route('services.index');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        Toastr::success('Service deleted successfully.', 'Success');
        return redirect()->route('services.index');
    }
}