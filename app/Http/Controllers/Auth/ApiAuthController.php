<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ResetPasswordOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiAuthController extends Controller
{
    /**
     * Handle an incoming API login request.
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'login' => 'required|string',
                'password' => 'required',
            ], [
                'login.required' => 'Please enter your email or mobile number.',
                'password.required' => 'Please enter your password.',
            ]);


            $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
            $request->merge([$loginField => $request->login]);

            $throttleKey = Str::lower($request->login) . '|' . $request->ip();

            if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
                $seconds = RateLimiter::availableIn($throttleKey);
                throw ValidationException::withMessages([
                    'login' => trans('auth.throttle', [
                        'seconds' => $seconds,
                        'minutes' => ceil($seconds / 60),
                    ]),
                ]);
            }

            // Check if user exists first
            $user = \App\Models\User::where($loginField, $request->login)->first();

            if (!$user) {
                throw ValidationException::withMessages([
                    'login' => ['Account not found. Please register first.'],
                ]);
            }

            // Now validate password
            if (!Hash::check($request->password, $user->password)) {
                RateLimiter::hit($throttleKey);
                throw ValidationException::withMessages([
                    'password' => ['Incorrect password.'],
                ]);
            }

            // Attempt login
            Auth::login($user);
            RateLimiter::clear($throttleKey);

            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'token' => $token,
                'data' => [
                    'userId' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'mobile' => $user->mobile,
                ],
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => collect($e->errors())->flatten()->first(),
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function register(Request $request)
    {
        try {
            // 1️⃣ Sanitize mobile: trim spaces + remove non‑digits
            $request->merge([
                'mobile' => preg_replace('/\D/', '', trim($request->mobile)),
            ]);
    
            // 2️⃣ Validate inputs with custom messages
            $validated = $request->validate([
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'mobile'   => ['required', 'digits:10', 'unique:users,mobile'],
                'password' => ['required', 'confirmed', 'min:8'],
            ], [
                'name.required'     => 'Please enter your full name.',
                'email.required'    => 'Email address is required.',
                'email.email'       => 'Please enter a valid email address.',
                'email.unique'      => 'This email is already registered.',
                'mobile.required'   => 'Mobile number is required.',
                'mobile.digits'     => 'Mobile number must be exactly 10 digits.',
                'mobile.unique'     => 'This mobile number is already registered.',
                'password.required' => 'Password is required.',
                'password.confirmed'=> 'Password confirmation does not match.',
                'password.min'      => 'Password must be at least 8 characters long.',
            ]);
    
            // 3️⃣ Check for existing user by email OR mobile
            $existingUser = \App\Models\User::where('email', $validated['email'])
                ->orWhere('mobile', $validated['mobile'])
                ->first();
    
            if ($existingUser) {
                throw ValidationException::withMessages([
                    'email'  => ['An account with this email or mobile number already exists.'],
                    'mobile' => ['Please use a different mobile number.'],
                ]);
            }
    
            // 4️⃣ Create user & fire Registered event
            $user = app(\App\Services\AuthService::class)->register($validated);
            event(new \Illuminate\Auth\Events\Registered($user));
    
            // 5️⃣ Generate token
            $token = $user->createToken('api-token')->plainTextToken;
    
            // 6️⃣ Return success
            return response()->json([
                'status'  => true,
                'message' => 'Registration successful',
                'token'   => $token,
                'data'    => [
                    'userId' => $user->id,
                    'name'   => $user->name,
                    'email'  => $user->email,
                    'mobile' => $user->mobile,
                ],
            ], 201);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            // 422: validation errors
            return response()->json([
                'status'  => false,
                'message' => collect($e->errors())->flatten()->first(),
                'errors'  => $e->errors(),
            ], 422);
    
        } catch (\Exception $e) {
            // 500: unexpected errors
            \Log::error('Registration error: ' . $e->getMessage());
            return response()->json([
                'status'  => false,
                'message' => 'Registration failed due to a system error. Please try again later.',
            ], 500);
        }
    }
    


    // public function login(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'login' => 'required|string', // Changed from 'email' to 'login'
    //             'password' => 'required',
    //         ]);

    //         $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
    //         $request->merge([$loginField => $request->login]);

    //         $throttleKey = Str::lower($request->login) . '|' . $request->ip();

    //         if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
    //             $seconds = RateLimiter::availableIn($throttleKey);
    //             throw ValidationException::withMessages([
    //                 'login' => trans('auth.throttle', [
    //                     'seconds' => $seconds,
    //                     'minutes' => ceil($seconds / 60)
    //                 ])
    //             ]);
    //         }

    //         if (!Auth::attempt($request->only($loginField, 'password'))) {
    //             RateLimiter::hit($throttleKey);
    //             throw ValidationException::withMessages([
    //                 'login' => [trans('auth.failed')] // Wrap in array
    //             ]);
    //         }

    //         RateLimiter::clear($throttleKey);
    //         $user = Auth::user();
    //         $token = $user->createToken('api-token')->plainTextToken;

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Login successful',
    //             'token' => $token,
    //             'data' => [
    //                 'userId' => $user->id,
    //                 'name' => $user->name,
    //                 'email' => $user->email,
    //                 'mobile' => $user->mobile, // Include mobile in response
    //             ]
    //         ], 200);
    //     } catch (ValidationException $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Authentication failed',
    //             'errors' => $e->errors()
    //         ], 200);
    //     }
    // }

    // public function register(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'mobile' => ['required', 'string', 'unique:users'],
    //         'password' => ['required', 'confirmed', 'min:8'], // Using default rules
    //     ]);

    //     try {
    //         $user = app(\App\Services\AuthService::class)->register($validated);
    //         event(new \Illuminate\Auth\Events\Registered($user));
    //         $token = $user->createToken('api-token')->plainTextToken;

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Registration successful',
    //             'token' => $token,
    //             'data' => [
    //                 'userId' => $user->id,
    //                 'name' => $user->name,
    //                 'email' => $user->email,
    //                 'mobile' => $user->mobile,
    //             ]
    //         ], 200);
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $e->getMessage(),
    //             'errors' => $e->errors()
    //         ], 200);
    //     } catch (\Exception $e) {
    //         \Log::error('Registration failed: ' . $e->getMessage());
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Registration failed. Please try again.',
    //         ], 500);
    //     }
    // }

    public function profileUpdate(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string'],
        ]);

        try {
            $user_id = Auth::user();


            $user = User::where('id', $user_id->id)->first(); // Get the authenticated user

            // Update only name and mobile
            $user->update([
                'name' => $validated['name'],
                'mobile' => $validated['mobile'],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully',
                'data' => [
                    'name' => $user->name,
                    'mobile' => $user->mobile,
                ],
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Profile update failed: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Profile update failed. Please try again.',
            ], 500);
        }
    }


    // Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    // // Send password reset link
    // public function sendResetLink(Request $request)
    // {
    //     $request->validate(['email' => 'required|email']);

    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );

    //     if ($status === Password::RESET_LINK_SENT) {
    //         return response()->json([
    //             'status' => true,
    //             'message' => __($status)
    //         ]);
    //     }

    //     throw ValidationException::withMessages([
    //         'email' => __($status)
    //     ]);
    // }

    // // Reset password
    // public function resetPassword(Request $request)
    // {
    //     // Validate the request and redirect back with errors if validation fails
    //     try {
    //         $request->validate([
    //             'token' => 'required',
    //             'email' => 'required|email',
    //             'password' => 'required|confirmed|min:8',
    //         ]);
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         return redirect()->back()
    //             ->withInput($request->except('password', 'password_confirmation')) // Preserve email but not passwords
    //             ->withErrors($e->errors()); // Redirect with validation errors
    //     }

    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user, $password) {
    //             $user->forceFill([
    //                 'password' => Hash::make($password)
    //             ])->save();

    //             event(new PasswordReset($user));
    //         }
    //     );

    //     if ($status === Password::PASSWORD_RESET) {
    //         return redirect()->back()
    //             ->with('password-reset-success', true)
    //             ->with('success', "Your password has been reset successfully! You can now log in using your email ({$request->email}) and your new password. Please use the KisanSAT mobile app to access your account. Thank you for using our service!");
    //     }

    //     return redirect()->back()
    //         ->withInput($request->only('email'))
    //         ->with('password-reset-error', true)
    //         // ->with('error', __($status));
    //         ->with('error', "This password reset token is invalid. Please open the KisanSAT mobile app and request a new password reset. If you need assistance, contact us at (" . config('services.app.mobile') . ").");
    // }

    public function farmerdelete(Request $req)
    {
        try {
            $user_id = Auth::id(); // Get authenticated user ID

            // Check if user exists
            $user = User::find($user_id);
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found.'
                ], 404);
            }

            // Perform soft delete
            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully.',
                'user_id' => $user_id
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'User deleted UnSuccessfully.'
            ], 500);
        }
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check if user exists
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        // Generate 4-digit OTP
        $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        // Store OTP in database (valid for 10 minutes)
        DB::table('password_otps')->updateOrInsert(
            ['email' => $request->email],
            ['otp' => $otp, 'created_at' => now()]
        );

        // Send OTP via email
        $user->notify(new ResetPasswordOtp($otp));

        return response()->json([
            'status' => true,
            'message' => 'OTP sent to your email',
            'email' => $request->email
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:4'
        ]);

        $record = DB::table('password_otps')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        // Check OTP validity (10 minutes)
        if (!$record || now()->diffInMinutes($record->created_at) > 10) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or expired OTP'
            ], 422);
        }

        return response()->json([
            'status' => true,
            'message' => 'OTP verified successfully'
        ]);
    }

    public function resetWithOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:4',
            'password' => 'required|confirmed|min:8',
        ]);

        // Verify OTP again
        $record = DB::table('password_otps')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        //OTP valid for xx minutes
        if (!$record || now()->diffInMinutes($record->created_at) > 60) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or expired OTP'
            ], 422);
        }

        // Update password
        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        // Clear OTP
        DB::table('password_otps')->where('email', $request->email)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Password reset successful'
        ]);
    }
}
    