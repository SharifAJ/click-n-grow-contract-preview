<?php

namespace App\Http\Controllers;

use App\Models\CareerApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CareerController extends Controller
{
    public function index()
    {
        return view('pages.careers');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'mobile_number' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255'],
            'city_state' => ['required', 'string', 'max:180'],
            'position' => ['required', 'string', 'max:180'],
            'highest_qualification' => ['required', 'string', 'max:180'],
            'specialization' => ['required', 'string', 'max:180'],
            'work_experience' => ['nullable', 'string', 'max:100'],
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'privacy_consent' => ['accepted'],
        ]);

        $validated['resume_path'] = $request->file('resume')->store('career-resumes', 'local');
        $validated['privacy_consent'] = true;
        unset($validated['resume']);
        CareerApplication::create($validated);

        return back()->with('status', 'Thank you. Your application has been submitted.');
    }

    public function applications()
    {
        $applications = CareerApplication::query()->latest()->paginate(25);

        return view('dashboard.careers.index', compact('applications'));
    }

    public function resume(CareerApplication $careerApplication): BinaryFileResponse
    {
        abort_unless(Storage::disk('local')->exists($careerApplication->resume_path), 404);

        return response()->download(Storage::disk('local')->path($careerApplication->resume_path));
    }
}
