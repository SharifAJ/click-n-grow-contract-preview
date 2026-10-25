<?php

namespace App\Http\Controllers\ContractFarming;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessAssociate;

class BusinessAssociateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = BusinessAssociate::latest()->get();
        return view('dashboard.contract_farming.business_associate.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.contract_farming.business_associate.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'state_district' => 'required|string|max:255',
            'experience' => 'nullable|integer|min:0|max:100',
            'operating_area' => 'nullable|string|max:255',
            'network_type' => 'nullable|string|max:255',
            'reason' => 'nullable|string|max:5000',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'preferred_contact' => 'nullable|string|in:call,whatsapp,email',
        ]);

        // Handle file upload
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('business_resumes', 'public');
        }

        // Create the business associate record
        BusinessAssociate::create([
            'full_name' => $validated['full_name'],
            'company_name' => $validated['company_name'],
            'mobile' => $validated['mobile'],
            'email' => $validated['email'],
            'state_district' => $validated['state_district'],
            'experience' => $validated['experience'],
            'operating_area' => $validated['operating_area'],
            'network_type' => $validated['network_type'],
            'reason' => $validated['reason'],
            'resume' => $resumePath,
            'preferred_contact' => $validated['preferred_contact'],
        ]);

        return redirect()->back()->with('success', 'Business Associate enquiry submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $record = BusinessAssociate::findOrFail($id);
        return view('dashboard.contract_farming.business_associate.view', compact('record'));
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
        $record = BusinessAssociate::findOrFail($id);
        $record->delete();
        return redirect()->route('contract_farming.business_associate.index')->with('success','Deleted successfully');
    }
}
