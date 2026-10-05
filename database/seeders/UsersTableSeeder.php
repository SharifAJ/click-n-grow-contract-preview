<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'farmer_id' => 'TU123',
            'name' => 'Test User',
            'last_name' => '',
            'email' => 'test@example.com',
            'mobile' => '12345678',
            'password' => Hash::make('12345678'),
        ]);
        User::factory()->create([
            'farmer_id' => 'SS123',
            'name' => 'Saniya Saher',
            'last_name' => '',
            'email' => 's@gmail.com',
            'mobile' => '1234567890',
            'password' => Hash::make('12345678'),
        ]);
       
    }
}
