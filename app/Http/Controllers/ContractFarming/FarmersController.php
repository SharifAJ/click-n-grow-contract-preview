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
        $validated = $request->all();

        if ($request->hasFile('upload_land_document')) {
            $validated['upload_land_document'] = $request->file('upload_land_document')->store('farmer_land_docs', 'public');
        }

        Farmer::create($validated);

        return redirect()->back()->with('success', 'Individual Farmer enquiry submitted successfully.');
    }

    public function publicStore(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'state_district' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'land_area' => 'required|numeric|min:0|max:999999.99',
            'irrigation' => 'required|string|in:yes,no',
            'land_type' => 'required|string|in:owned,leased',
            'previous_crops' => 'nullable|string|max:255',
            'interested_crops' => 'nullable|string|max:255',
            'start_month' => 'nullable|string|in:january,february,march,april,may,june,july,august,september,october,november,december',
            'support' => 'nullable|array',
            'support.*' => 'string|in:technical_guidance,input_supply,buyback_contract,training',
            'additional_comments' => 'nullable|string|max:5000',
        ]);

        $validated['irrigation'] = ucfirst($validated['irrigation']);
        $validated['land_type'] = ucfirst($validated['land_type']);
        $validated['preferred_support'] = $validated['support'] ?? [];
        unset($validated['support']);

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
