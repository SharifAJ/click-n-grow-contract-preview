<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PackageMasterModel;
use App\Models\PackageServiceModel;
use App\Models\ServiceMasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PackageMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pack_master_data = PackageMasterModel::withCount('services')->orderByDesc('id')->get();

        // dd($pack_master_data);
        return view('dashboard.setting.package.index', [
            'pack_master_data' => $pack_master_data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve the service record
        $service_data = ServiceMasterModel::where('status', 'active')->get();


        return view('dashboard.setting.package.create', [
            'service_data' => $service_data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'duration' => 'required|in:1,6,12,-1',
            'amount' => 'required|numeric|min:0|max:99999999.99',
            'services' => 'required|array|min:1', // Ensure at least one service is selected
            'services.*' => 'exists:service_masters,id', // Validate service IDs
        ]);

        // Create package entry in package_master table
        $package = PackageMasterModel::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'duration' => $validated['duration'],
            'amount' => $validated['amount'],
        ]);

        // Attach services using ORM
        foreach ($validated['services'] as $serviceId) {
            PackageServiceModel::create([
                'package_id' => $package->id,
                'service_id' => $serviceId,
            ]);
        }


        return redirect()->route('servicemaster.index')->with('success', 'Package master created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve the package record
        $packageMaster_data = PackageMasterModel::where('id', $id)->first();
        $packageMaster_data->duration = $packageMaster_data->getDurationLabelsAttribute();

        // Get all related service IDs from PackageServiceModel
        $serviceIds = PackageServiceModel::where('package_id', $id)->pluck('service_id');
        $serviceIds = PackageServiceModel::where('package_id', $id)->pluck('service_id');

        // Fetch the services from ServiceMasterModel where the ID matches
        $service_data = ServiceMasterModel::whereIn('id', $serviceIds)
            ->where('status', 'active')
            ->get();
 
        return view('dashboard.setting.package.view', [
            'packageMaster_data' => $packageMaster_data,
            'service_data' => $service_data, // Pass the service data to the view
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $package = PackageMasterModel::findOrFail($id);

        // Fetch all active services
        $service_data = ServiceMasterModel::where('status', 'active')->get();

        // Fetch already selected services for the package
        $selected_services = DB::table('package_service')->where('package_id', $id)->pluck('service_id')->toArray();
        // dd($selected_services);
        return view('dashboard.setting.package.edit', [
            'package' => $package,
            'service_data' => $service_data,
            'selected_services' => $selected_services,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // dd($request);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'duration' => 'required|in:1,6,12,-1',
            'amount' => 'required|numeric|min:0|max:99999999.99',
            'services' => 'required|array|min:1', // Ensure at least one service is selected
            'services.*' => 'exists:service_masters,id', // Validate service IDs
        ]);


        $package = PackageMasterModel::findOrFail($id);
        $package->update($validated);

        PackageServiceModel::where('package_id', $id)->delete();

        foreach ($validated['services'] as $serviceId) {
            PackageServiceModel::create([
                'package_id' => $id,
                'service_id' => $serviceId,
            ]);
        }

        return redirect()->route('servicemaster.index')->with('success', 'Package master updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function package_master_status(Request $request)
    {
        $pack_id = (int) $request->pack_master_id;
        $status = $request->status;

        // Fetch the package master data
        $PackageMaster_data = PackageMasterModel::find($pack_id);

        // Check if package master exists
        if (!$PackageMaster_data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Package Master data not found.',
            ]);
        }

        // Debugging
        // dd($pack_id, $status, $PackageMaster_data);

        // Update the package master status
        $PackageMaster_data->update(['status' => $status]);

        // Set message based on status
        $message = ($status == 'active') ? 'Package Master activated successfully.' : 'Package Master deactivated successfully.';

        return response()->json([
            'status' => 'success',
            'message' => $message,
        ]);
    }

}
