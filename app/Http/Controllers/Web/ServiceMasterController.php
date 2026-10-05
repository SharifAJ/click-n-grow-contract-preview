<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\FarmModel;
use App\Models\PackageMasterModel;
use App\Models\ServiceMasterModel;
use Illuminate\Http\Request;

class ServiceMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ser_master_data = ServiceMasterModel::orderByDesc('id')->get()->map(function ($service) {
            $service->duration = $service->getDurationLabelsAttribute();
            return $service;
        });

        $pack_master_data = PackageMasterModel::withCount('services')->orderByDesc('id')->get()->map(function ($package) {
            $package->duration = $package->getDurationLabelsAttribute();
            return $package;
        });
        // dd($pack_master_data);
        return view('dashboard.setting.service.index', [
            'ser_master_data' => $ser_master_data,
            'pack_master_data' => $pack_master_data,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('hii');

        return view('dashboard.setting.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'service_type' => 'required|in:premium,free',
            'duration' => 'required|array',
            // 'duration.*' => 'in:1,3,6,12,lifetime,free,once', // Validate each value
            'amount' => 'required|numeric|min:0|max:99999999.99',
            'description' => 'nullable|string|max:1000'
        ]);

        // Convert the duration array to JSON
        $validated['duration'] = json_encode($validated['duration']);

        ServiceMasterModel::create($validated);

        return redirect()->route('servicemaster.index')->with('success', 'Service Master created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve the service record
        $ServiceMaster_data = ServiceMasterModel::where('id', $id)->first();

        // Convert duration to readable labels
        $ServiceMaster_data->duration = $ServiceMaster_data->getDurationLabelsAttribute();

        return view('dashboard.setting.service.view', [
            'ServiceMaster_data' => $ServiceMaster_data,
        ]);
    }

    // dd($data);

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $serviceMaster = ServiceMasterModel::findOrFail($id);

        // Decode only if it is a JSON string
        if (is_string($serviceMaster->duration)) {
            $serviceMaster->duration = json_decode($serviceMaster->duration, true) ?? [];
        }

        return view('dashboard.setting.service.edit', compact('serviceMaster'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the service by ID
        $service = ServiceMasterModel::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'service_type' => 'required|in:premium,free',
            'duration' => 'required|array',
            // 'duration.*' => 'in:1,3,6,12,lifetime,free,once',
            'amount' => 'required|numeric|min:0|max:99999999.99',
            'description' => 'nullable|string|max:1000'
        ]);

        // Convert duration to JSON before saving
        $validated['duration'] = json_encode($validated['duration']);

        // Update the record
        $service->update($validated);

        return redirect()->route('servicemaster.index')->with('success', 'Service Master updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function serv_master_status(Request $request)
    {
        $ser_id = $request->serv_master_id;
        $status = $request->status;

        // Fetch the user data
        $ServiceMaster_data = ServiceMasterModel::where('id', $ser_id)->first();

        // Check if user data exists
        if (!$ServiceMaster_data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Farmer data not found.',
            ]);
        }

        // Update the user status
        ServiceMasterModel::where('id', $ser_id)->update(['status' => $status]);

        // Set message based on status
        $message = ($status === 'active') ? 'Service master activated successfully.' : 'Service master deactivated successfully.';

        return response()->json([
            'status' => 'success',
            'message' => $message,
        ]);
    }
}
