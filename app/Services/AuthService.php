<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
 /**
     * Registers a new farmer using shared logic.
     *
     * @param  array  $data  Validated data from the controller.
     * @return \App\Models\User
     *
     * @throws \Exception
     */
    public function register(array $data): User
    {
        // Generate farmer_id: first letter of first name + first letter of last name (if exists) + first 4 digits of mobile
        $nameParts = explode(' ', trim($data['name']));
        $firstLetter = strtoupper(substr($nameParts[0], 0, 1));
        $lastLetter = isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : '';
        $mobileStart = substr($data['mobile'], 0, 4);
        $data['farmer_id'] = $firstLetter . $lastLetter . $mobileStart;

        // Wrap the creation in a transaction
        DB::beginTransaction();
        try {
            $user = User::create([
                'farmer_id'   => $data['farmer_id'],
                'name'        => $data['name'],
                'email'       => $data['email'],
                'mobile'      => $data['mobile'],
                'reg_date'    => $data['reg_date'] ?? now(),
                'user_status' => 'active',
                'password'    => Hash::make($data['password']),
            ]);

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
