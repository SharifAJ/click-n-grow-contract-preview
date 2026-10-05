<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ContactUsMail;
use App\Models\ContactUsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = ContactUsModel::orderByDesc('id')->get();
        return view('dashboard.contact_us.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.contact-us');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Validate request
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'mobile' => [
                'nullable',
                'digits:10', // Exactly 10 digits
            ],
            'address' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
        ], [
            'mobile.digits' => 'Mobile number must be exactly 10 digits.',
        ]);

        // Remove extra spaces and sanitize the message
        $validatedData['message'] = trim(preg_replace('/\s+/', ' ', $validatedData['message']));


        // Create the contact entry
        ContactUsModel::create($validatedData);

        // Send email to admin
        Mail::to(env('ADMIN_EMAIL'))->send(new ContactUsMail($validatedData));

        // Return response (adjust as needed)
        return redirect()->back()->with('success', 'Your message has been submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
