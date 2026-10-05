<?php

namespace App\Http\Controllers\ContractFarming;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry; 

use App\Models\BusinessAssociate;
use App\Models\Farmer;
use App\Models\FPO;


class EnquiryController extends Controller
{
    /**
     * Display a listing of the enquiries. 
     */
    public function index()
    {
        $enquiries = Enquiry::latest()->get();
        $business_associate_enquires = BusinessAssociate::latest()->get();
        $farmers = Farmer::latest()->get();
        $fpos = FPO::latest()->get();
        return view('dashboard.contract_farming.enquiry.index', compact('enquiries', 'business_associate_enquires', 'farmers', 'fpos'));
    }

    /**
     * Show the form for creating a new enquiry.
     */
    public function create()
    {
        return view('dashboard.contract_farming.enquiry.create');
    }

    /**
     * Store a newly created enquiry in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'mobile'  => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'message' => 'nullable|string|max:1000',
        ]);

        Enquiry::create($request->only('name', 'email', 'mobile', 'address', 'message'));

        return redirect()->route('contract')->with('success', 'Your enquiry has been submitted successfully!');

    }

    /**
     * Display the specified enquiry.
     */
    public function show($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        return view('dashboard.contract_farming.enquiry.view', compact('enquiry'));
    }

    /**
     * Remove the specified enquiry from storage.
     */
    public function destroy($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();

        return redirect()->route('contract_farming.enquiry.index')
                 ->with('success', 'Enquiry deleted successfully.');

    }

    // public function publicStore(Request $request)
    // {
    //     $request->validate([
    //         'name'    => 'required|string|max:255',
    //         'email'   => 'required|email|max:255',
    //         'mobile'  => 'nullable|string|max:20',
    //         'address' => 'nullable|string|max:500',
    //         'message' => 'nullable|string|max:1000',
    //     ]);

    //     Enquiry::create($request->only('name', 'email', 'mobile', 'address', 'message'));

    //     return back()->with('success', 'Your enquiry has been sent successfully!');
    // }

}