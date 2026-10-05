<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // If there’s a row in the table, get it; otherwise give me a new Setting instance.
        $setting = Setting::first()     // fetch the first record…
            ?? new Setting();   // …or, if null, create a fresh model

        return view('dashboard.setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'application_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'about_us' => 'required|string',
            'application_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Fetch first settings record or create if not exists
        $setting = Setting::firstOrNew([]);

        if ($request->hasFile('application_logo')) {
            // Delete old logo if exists
            if ($setting->application_logo) {
                Storage::disk('public')->delete($setting->application_logo);
            }
            // Store new file with a proper name
            $file = $request->file('application_logo');
            $fileName = 'kisansat-main-logo.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('settings', $fileName, 'public');
            $setting->application_logo = $filePath;
        }

        // Update fields
        $setting->fill($request->only([
            'application_name',
            'company_address',
            'company_email',
            'phone_number',
            'about_us'
        ]));

        $setting->save(); // Save updated values

        if ($setting->wasRecentlyCreated || $setting->wasChanged()) {
            return redirect()->back()->with('success', 'Settings updated successfully.');
        } else {
            return redirect()->back()->with('error', 'No changes were made.');
        }
    }
}
