<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\FarmModel;
use App\Models\PackageMasterModel;
use App\Models\ServiceMasterModel;
use App\Models\SubscriptionModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Exception;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // // $farms  = FarmModel::with('user')->orderByDesc('id')->get();
        $users = User::with('farms')->withTrashed()->withCount('farms')->orderByDesc('id')->get(); //farms_count variable
        // dd($users);



        return view('dashboard.farmer.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.farmer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'last_name' => 'nullable|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'mobile' => 'required|digits:10|numeric|unique:users,mobile',
    //         'reg_date' => [
    //             'required',
    //             'date',
    //             'before_or_equal:today', // Ensure the date is not in the future
    //         ],
    //         'password' => [
    //             'required',
    //             'string',
    //             'min:8',
    //             'confirmed',
    //             function ($attribute, $value, $fail) {
    //                 // // Ensure the password starts with an uppercase letter
    //                 // if (!preg_match('/^[A-Z]/', $value)) {
    //                 //     $fail('The password must start with an uppercase letter.');
    //                 // }

    //                 // Ensure the password contains at least one special character
    //                 if (!preg_match('/[\W]/', $value)) {
    //                     $fail('The password must contain at least one special character ($, @, #, etc.).');
    //                 }

    //                 // // Ensure the password ends with a number
    //                 // if (!preg_match('/[0-9]$/', $value)) {
    //                 //     $fail('The password must end with a number.');
    //                 // }

    //                 // Check uniqueness against stored hashed passwords
    //                 $existingPasswords = DB::table('users')->pluck('password')->toArray();
    //                 foreach ($existingPasswords as $hashedPassword) {
    //                     if (Hash::check($value, $hashedPassword)) {
    //                         $fail('The password must be unique. Choose a different password.');
    //                         return;
    //                     }
    //                 }
    //             }
    //         ],
    //     ]);

    //     try {
    //         DB::beginTransaction();

    //         // Generate farmer_id: First and last letter of name + first 4 digits of mobile
    //         $nameParts = explode(' ', trim($request->name));
    //         $firstLetter = strtoupper(substr($nameParts[0], 0, 1)); // First letter of first name
    //         $lastLetter = isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : ''; // First letter of last name or 'X' if no last name
    //         $mobileStart = substr($request->mobile, 0, 4); // First 4 digits of mobile

    //         $farmer_id = $firstLetter . $lastLetter . $mobileStart;

    //         // Create a new farmer record
    //         User::create([
    //             'farmer_id' => $farmer_id,
    //             'name' => $request->name,
    //             'last_name' => $request->last_name,
    //             'email' => $request->email,
    //             'mobile' => $request->mobile,
    //             'reg_date' => $request->reg_date, // Ensure reg_date is stored
    //             'user_status' => 'active', // Default status
    //             'password' => Hash::make($request->password), // Secure password
    //         ]);

    //         DB::commit();
    //         return redirect()->route('farmer.index')->with('success', 'Farmer added successfully.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         \Log::error('Error adding farmer: ' . $e->getMessage()); // Log the actual error for debugging
    //         return redirect()->back()->with('error', 'Something went wrong! Please try again.');
    //     }
    // }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|digits:10|numeric|unique:users,mobile',
            'reg_date' => 'required|date|before_or_equal:today',
            'password' => 'required|string|min:8|confirmed', // Using default rules now
        ]);

        // dd($validated);
        try {
            $user = app(\App\Services\AuthService::class)->register($validated);
            return redirect()->route('farmer.index')->with('success', 'Farmer added successfully.');
        } catch (\Exception $e) {
            \Log::error('Error adding farmer: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user_data = User::where('.id', $id)
            ->withTrashed()
            ->first();
        $farmer_data = FarmModel::join('users', 'farms.user_id', '=', 'users.id')
            ->select(
                'farms.name as farm_name',
                'farms.farm_id',
                'farms.croptype',
                'farms.category',
                'farms.sowingdate',
                'farms.crop_variety',
                'farms.district',
                'farms.state',
                'farms.status'
            )
            ->where('farms.user_id', $id)
            ->get();

        $data = [
            'user_data' => $user_data,
            'farmer_data' => $farmer_data,
        ];

        return view('dashboard.farmer.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user_data = User::where('.id', $id)
            ->first();
        $farmer_data = FarmModel::join('users', 'farms.user_id', '=', 'users.id')
            ->select(
                'farms.name as farm_name',
                'farms.farm_id',
                'farms.croptype',
                'farms.category',
                'farms.sowingdate',
                'farms.crop_variety',
                'farms.district',
                'farms.state',
                'farms.status'
            )
            ->where('farms.user_id', $id)
            ->get();
        // dd($farmer_data);
        $data = [
            'user_data' => $user_data,
            'farmer_data' => $farmer_data,
        ];

        return view('dashboard.farmer.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate input fields
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required|digits:10|numeric|unique:users,mobile,' . $id,
            'reg_date' => 'required|date|before_or_equal:today',
            'password' => 'nullable|min:8|confirmed',
        ]);

        try {
            // Find the user
            $user = User::findOrFail($id);

            // Update user details
            $user->name = $validatedData['name'];
            $user->last_name = $validatedData['last_name'] ?? '';
            $user->email = $validatedData['email'];
            $user->mobile = $validatedData['mobile'];
            $user->reg_date = $validatedData['reg_date'];

            // Update password only if provided
            if (!empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }

            $user->save();

            return redirect()->route('farmer.index')->with('success', 'Farmer details updated successfully!');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Farmer not found!');
        } catch (Exception $e) {
            \Log::error('Error updating farmer: ' . $e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Something went wrong! Please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            // Check if user exists
            $user = User::find($id);
            if (!$user) {
                return redirect()->route('farmer.index')->with('error', 'Farmer not found');
            }

            // Perform soft delete
            $user->delete();
            return redirect()->route('farmer.index')->with('success', 'Farmer deleted successfully.');


        } catch (\Exception $e) {
            return redirect()->route('farmer.index')->with('error', 'Farmer deleted UnSuccessfully.');
        }
    }
    public function farmer_restore(string $id)
    {

        try {
            // Check if user exists
            $user = User::withTrashed()->find($id);
            if (!$user) {
                return redirect()->route('farmer.index')->with('error', 'Farmer not found');
            }

            // Perform soft delete
            $user->restore();
            return redirect()->route('farmer.index')->with('success', 'Farmer restore successfully.');


        } catch (\Exception $e) {
            return redirect()->route('farmer.index')->with('error', 'Farmer restore UnSuccessfully.');
        }
    }


    public function farmer_data(string $id)
    {
        $farmer_data = FarmModel::join('users', 'farms.user_id', '=', 'users.id')
            ->select(
                'users.name as user_name',
                'users.email',
                'users.mobile',
                'farms.id as farmid',
                'farms.name as farm_name',
                'farms.farm_id',
                'farms.croptype',
                'farms.category',
                'farms.sowingdate',
                'farms.crop_variety',
                'farms.district',
                'farms.state',
                'farms.status'
            )
            ->where('farms.user_id', $id)
            ->get();

        return response()->json($farmer_data); // ✅ Return JSON response for AJAX
    }


    public function farmer_status(Request $request)
    {
        $user_id = $request->user_id;
        $status = $request->status;

        // Fetch the user data
        $user_data = User::where('id', $user_id)->first();

        // Check if user data exists
        if (!$user_data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Farmer data not found.',
            ]);
        }

        // Update the user status
        User::where('id', $user_id)->update(['user_status' => $status]);

        // Set message based on status
        $message = ($status === 'active') ? 'Farmer activated successfully.' : 'Farmer deactivated successfully.';

        return response()->json([
            'status' => 'success',
            'message' => $message,
        ]);
    }
}
