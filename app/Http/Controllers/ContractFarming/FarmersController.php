<?php

namespace App\Http\Controllers\ContractFarming;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farmer;

class FarmersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Farmer::latest()->get();
        return view('dashboard.contract_farming.farmer.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.contract_farming.farmer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email',
            'state_district_taluka' => 'required|string|max:255',
            'land_size' => 'nullable|numeric',
            'current_crops' => 'nullable|string|max:255',
            'interested_crop' => 'nullable|string|max:255',
            'expected_start_time' => 'nullable|string|max:255',
            'support_required' => 'nullable|array',
            'upload_land_document' => 'nullable|file|mimes:pdf,jpg,png',
            'remarks' => 'nullable|string',
        ]);
        */
        $validated = $request->all();

        if ($request->hasFile('upload_land_document')) {
            $validated['upload_land_document'] = $request->file('upload_land_document')->store('farmer_land_docs', 'public');
        }

        Farmer::create($validated);

        return redirect()->back()->with('success', 'Individual Farmer enquiry submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $record = Farmer::findOrFail($id);
        return view('dashboard.contract_farming.farmer.view', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Farmer::findOrFail($id);
        $record->delete();
        return redirect()->route('contract_farming.farmer.index')->with('success','Deleted successfully');
    }
}
