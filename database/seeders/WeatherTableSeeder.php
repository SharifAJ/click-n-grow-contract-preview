<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WeatherTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('weather')->delete();
        
        
        
    }
}