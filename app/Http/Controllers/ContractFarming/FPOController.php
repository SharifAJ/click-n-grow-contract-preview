<?php

namespace App\Http\Controllers\ContractFarming;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FPO;

class FPOController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = FPO::latest()->get();
        return view('dashboard.contract_farming.fpo.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.contract_farming.fpo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|max:255',
            'contact_person' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email',
            'state_district_taluka' => 'required|string|max:255',
            'number_of_farmers' => 'nullable|integer',
            'total_land' => 'nullable|numeric',
            'current_crops' => 'nullable|string|max:255',
            'interested_crop' => 'nullable|string|max:255',
            'expected_start_time' => 'nullable|string|max:255',
            'support_required' => 'nullable|array',
            'upload_group_profile' => 'nullable|file|mimes:pdf,jpg,png',
            'remarks' => 'nullable|string',
        ]);
        */

        $validated = $request->all();

        if ($request->hasFile('upload_group_profile')) {
            $validated['upload_group_profile'] = $request->file('upload_group_profile')->store('fpo_profiles', 'public');
        }

        FPO::create($validated);

        return redirect()->back()->with('success', 'FPO enquiry submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $record = FPO::findOrFail($id);
        return view('dashboard.contract_farming.fpo.view', compact('record'));
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
        $record = FPO::findOrFail($id);
        $record->delete();
        return redirect()->route('contract_farming.fpo.index')->with('success','Deleted successfully');
    }
}
