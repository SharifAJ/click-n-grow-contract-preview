<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContractFarming;

class ContractFarmingController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:farmers,email',
            'mobile' => 'required|digits:10',
            'reg_date' => 'required|date',
            'password' => 'required|confirmed|min:8',
        ]);

        // Data save
        ContractFarming::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'reg_date' => $validated['reg_date'],
            'password' => bcrypt($validated['password']), 
        ]);

        return redirect()
            ->route('dashboard.contract_farming.corps.index')
            ->with('success', 'Farmer added successfully.');
    }

    public function index()
    {
        $farmers = ContractFarming::all(); 
        return view('dashboard.contract_farming.crops.index', compact('farmers'));
    }
}
