<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::updateOrCreate(
            ['email' => 'admin@kisansat.com'],
            ['password' => Hash::make('12345678')]
        );

        Admin::updateOrCreate(
            ['email' => 'admin@admin.com'],
            ['password' => Hash::make('admin123')]
        );
    }
}
