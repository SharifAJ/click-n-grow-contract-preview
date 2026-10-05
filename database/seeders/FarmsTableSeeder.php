<?php

namespace Database\Seeders;

use App\Models\FarmModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class FarmsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        FarmModel::factory(10)->create();
    }
}
