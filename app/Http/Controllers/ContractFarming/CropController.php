<?php

namespace App\Http\Controllers\ContractFarming;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crop;


class CropController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $crops = Crop::orderBy('name', 'asc')->get(); // Sorted by name
    //     return view('dashboard.contract_farming.crops.index', compact('crops'));

        
    // }

    public function index()
    {
        $crops = Crop::latest('updated_at')->get(); // fetch latest records
        // $crops = Crop::all();
        return view('dashboard.contract_farming.crops.index', compact('crops'));

        // return view('dashboard.contract_farming.crops.index', compact('crops'));
    }


    public function getSowingMonthsAttribute()
    {
        if ($this->sowing_start && $this->sowing_end) {
            $start = date('n', strtotime($this->sowing_start));
            $end = date('n', strtotime($this->sowing_end));
            $months = [];
            for ($i = $start; $i <= $end; $i++) {
                $months[] = date('F', mktime(0, 0, 0, $i, 1));
            }
            return $months;
        }
        return [];
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.contract_farming.crops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'icon' => 'required|string|max:10',
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'details' => 'nullable|string',
    //         'sowing_months' => 'nullable|array',
    //         'sowing_months.*' => 'string',
    //         'pdf_en' => 'nullable|file|mimes:pdf|max:2048',
    //         'pdf_hi' => 'nullable|file|mimes:pdf|max:2048',
    //         'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    //     ]);

    //     $crop = new Crop();
    //     $crop->icon = $validated['icon'];
    //     $crop->name = $validated['name'];
    //     $crop->description = $validated['description'];
    //     $crop->details = $validated['details'] ?? null;
    //     $crop->sowing_months = $validated['sowing_months'] ?? [];
        
    //     $crop->sowing_months = $request->sowing_months ? json_encode($request->sowing_months) : null;
    //     // $crop->sowing_months = $request->sowing_months ?? [];


    //     // Store pdfs
    //     if ($request->hasFile('pdf_en')) {
    //         $crop->pdf_en = $request->file('pdf_en')->store('pdfs', 'public');
    //     }
    //     if ($request->hasFile('pdf_hi')) {
    //         $crop->pdf_hi = $request->file('pdf_hi')->store('pdfs', 'public');
    //     }

    //     // Store multiple images
    //     $imagePaths = [];
    //     if ($request->hasFile('images')) {
    //         foreach ($request->file('images') as $image) {
    //             $imagePaths[] = $image->store('crops/images', 'public');
    //         }
    //     }
    //     $crop->images = $imagePaths ? json_encode($imagePaths) : null;

    //     $crop->save();

    //     return redirect()->route('contract_farming.crops.index')
    //         ->with('success', 'Crop created successfully.');

    // }



    public function store(Request $request)
    {
        // Define valid months
        $monthsList = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        // Validate the request
        $validated = $request->validate([
            // 'icon' => 'required|string|max:10',
            'name' => 'required|string|max:255|unique:crops,name',
            'description' => 'required|string|max:1000',
            'details' => 'nullable|string|max:5000',
            'sowing_months' => 'nullable|array',
            'sowing_months.*' => 'string|in:' . implode(',', $monthsList),
            'pdf_en' => 'nullable|file|mimes:pdf|max:10240',
            'pdf_hi' => 'nullable|file|mimes:pdf|max:10240',
            'images' => 'nullable|array|max:12',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,avif|max:5120',
        ]);

        try {
            // Create new crop instance
            $crop = new Crop();
            
            // Set basic fields
            $crop->icon = $request->input('icon', '🌾');
            $crop->name = $validated['name'];
            $crop->description = $validated['description'];
            $crop->details = $validated['details'];

            // Handle sowing months - ensure it's always stored as JSON
            if (!empty($validated['sowing_months'])) {
                $crop->sowing_months = json_encode($validated['sowing_months']);
            } else {
                $crop->sowing_months = null;
            }




            // Handle PDF uploads
            if ($request->hasFile('pdf_en')) {
                $crop->pdf_en = $request->file('pdf_en')->store('crops/pdfs', 'public');
            }
            
            if ($request->hasFile('pdf_hi')) {
                $crop->pdf_hi = $request->file('pdf_hi')->store('crops/pdfs', 'public');
            }

            if ($request->hasFile('images') && is_array($request->file('images'))) {
                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    $imagePaths[] = $image->store('crops/images', 'public');
                }
                $crop->images = json_encode($imagePaths);
            } else {
                $crop->images = null;
            }
            // Save the crop
            $crop->save();

            return redirect()->route('contract_farming.crops.index')
                ->with('success', "Crop '{$crop->name}' created successfully.");

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Crop creation failed: ' . $e->getMessage(), [
                'request_data' => $request->except(['pdf_en', 'pdf_hi', 'images']),
                'error' => $e->getMessage()
            ]);

            return redirect()->back()
                ->withInput($request->except(['pdf_en', 'pdf_hi', 'images']))
                ->with('error', 'Failed to create crop. Please try again.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $crop = Crop::findOrFail($id);
        return view('dashboard.contract_farming.crops.show', compact('crop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     $crop = Crop::findOrFail($id);
    //     // dd($crop);

    //       $crop->sowing_months = $crop->sowing_months 
    //  ? explode(',', $crop->sowing_months) 
    //     : [];
    //     return view('dashboard.contract_farming.crops.edit', compact('crop'));
    // }

//     public function edit($id)
// {
//     $crop = Crop::findOrFail($id);

//     // sowing_months will already be an array because of the cast
//     $crop->sowing_months = $crop->sowing_months ?? [];

//     return view('dashboard.contract_farming.crops.edit', compact('crop'));
// }

// public function edit($id)
// {
//     $crop = Crop::findOrFail($id);

//     // Ensure sowing_months is an array
//     $crop->sowing_months = json_decode($crop->sowing_months, true) ?? [];

//     return view('dashboard.contract_farming.crops.edit', compact('crop'));
// }




public function edit($id)
{
    $crop = Crop::findOrFail($id);

    // Check if sowing_months is a string and decode if necessary
    if (is_string($crop->sowing_months)) {
        $crop->sowing_months = json_decode($crop->sowing_months, true) ?? [];
    }

    return view('dashboard.contract_farming.crops.edit', compact('crop'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $crop = Crop::findOrFail($id);

       $monthsList = ['January','February','March','April','May','June','July','August','September','October','November','December'];

        $validated = $request->validate([
            // 'icon' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'details' => 'nullable|string',
            'sowing_months' => 'nullable|array', // should be array
            'sowing_months.*' => 'string|in:' . implode(',', $monthsList), // each month must be valid
            'pdf_en' => 'nullable|file|mimes:pdf|max:10240',
            'pdf_hi' => 'nullable|file|mimes:pdf|max:10240',
            'images' => 'nullable|array|max:12',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,avif|max:5120',
        ]);

        // Update text fields
        $crop->icon = $request->input('icon', '🌾');
        $crop->name = $validated['name'];
        $crop->description = $validated['description'];
        $crop->details = $validated['details'] ?? null;

        // Update sowing months (JSON encode)
        // $crop->sowing_months = $validated['sowing_months'] ? $validated['sowing_months'] : json_encode([]);
        $crop->sowing_months = $validated['sowing_months'] ?? [];



        // Update PDFs if new files uploaded
        if ($request->hasFile('pdf_en')) {
            $crop->pdf_en = $request->file('pdf_en')->store('pdfs', 'public');
        }
        if ($request->hasFile('pdf_hi')) {
            $crop->pdf_hi = $request->file('pdf_hi')->store('pdfs', 'public');
        }

        // Handle images
        $existingImages = $crop->images ? json_decode($crop->images) : [];
        $newImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $newImages[] = $image->store('crops/images', 'public');
            }
        }

        // Merge existing and new images
        $crop->images = json_encode(array_merge($existingImages, $newImages));

        $crop->save();

        return redirect()->route('contract_farming.crops.index')
            ->with('success', 'Crop updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $crop = Crop::findOrFail($id);

        // Delete images
        if ($crop->images) {
            foreach (json_decode($crop->images) as $img) {
                if (\Storage::exists($img)) {
                    \Storage::delete($img);
                }
            }
        }

        // Delete PDFs
        if ($crop->pdf_en && \Storage::exists($crop->pdf_en)) {
            \Storage::delete($crop->pdf_en);
        }
        if ($crop->pdf_hi && \Storage::exists($crop->pdf_hi)) {
            \Storage::delete($crop->pdf_hi);
        }

        // Delete database record
        $crop->delete();

        return redirect()->route('contract_farming.crops.index')
            ->with('success', 'Crop deleted successfully.');
        }
}
