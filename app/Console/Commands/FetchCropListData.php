<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\CropListModel;

class FetchCropListData extends Command
{
    protected $signature = 'crop-list:fetch';
    protected $description = 'Fetch Crop List Data and update database if new crop list values found';

    public function handle()
    {
        $baseUrl = config('services.satyukt_api.url');
        $url = "$baseUrl/Crops"; // API URL

        try {
            $response = Http::get($url);
            $responseData = $response->json();

            if (!is_array($responseData) || empty($responseData)) {
                Log::warning('Crop List API returned invalid or empty response.');
                $this->error('Invalid or empty response from Crop List API.');
                return;
            }

            // Get existing crop names from the database
            $existingCrops = CropListModel::pluck('crop_name')->toArray();

            // Filter out already existing crops
            $newCrops = array_filter($responseData, fn($cropName) => !in_array($cropName, $existingCrops));

            if (empty($newCrops)) {
                $this->info('No new crops found. Database is up-to-date.');
                return;
            }

            // Convert new crop names into an array for insertion
            $cropData = array_map(fn($cropName) => ['crop_name' => $cropName], $newCrops);

            // Insert only new crops
            CropListModel::insert($cropData);

            $this->info('New crops added successfully: ' . implode(', ', $newCrops));
            Log::info('New crops added:', $newCrops);
        } catch (\Exception $e) {
            Log::error('FetchCropListData Command Error: ' . $e->getMessage());
            $this->error('Failed to fetch crops: ' . $e->getMessage());
        }
    }
}