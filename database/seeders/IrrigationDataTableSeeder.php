<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IrrigationDataTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('irrigation_data')->delete();
        
        
        
    }
}