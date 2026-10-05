<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\MandiRate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class MandiRateCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mandirate:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiUrl = "https://api.data.gov.in/resource/9ef84268-d588-465a-a308-a864a43d0070?api-key=579b464db66ec23bdd000001db51822accae49b4565ff4dd856633cf&format=json&offset=100&limit=28000";

        // Log the API URL before making the request
        Log::info("Fetching Mandi rates from API", ['url' => $apiUrl]);

        try {
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                $data = $response->json();
                $records = $data['records'] ?? [];

                $uniqueRecords = collect($records)->unique(function ($record) {
                    return $record['state'] . $record['district'] . $record['market'] . $record['commodity'] .
                        $record['variety'] . $record['grade'] . $record['arrival_date'];
                })->values();

                foreach ($uniqueRecords as $record) {
                    try {
                        // Convert the date format correctly
                        $arrivalDate = Carbon::createFromFormat('d/m/Y', $record['arrival_date'])->format('Y-m-d');


                        // Insert or update the record
                        MandiRate::updateOrCreate(
                            [
                                'state' => $record['state'],
                                'district' => $record['district'],
                                'market' => $record['market'],
                                'commodity' => $record['commodity'],
                                'variety' => $record['variety'],
                                'grade' => $record['grade'],
                                'arrival_date' => $arrivalDate,
                            ],
                            [
                                'min_price' => $record['min_price'],
                                'max_price' => $record['max_price'],
                                'modal_price' => $record['modal_price'],
                            ]
                        );

                    } catch (\Exception $e) {
                        Log::error("Date Parsing Error: " . $e->getMessage(), ['record' => $record]);
                    }
                }


                // Delete records older than 1 week
                // $weekAgo = Carbon::now()->subWeek()->format('Y-m-d');
                // MandiRate::where('arrival_date', '<', $weekAgo)->delete();

                $this->info("Mandi rates fetched and saved successfully.");
                Log::info("Mandi rates fetched and saved successfully.");
            } else {
                $errorMessage = "API Request Failed: " . $response->body();
                $this->error($errorMessage);
                Log::error($errorMessage);
            }
        } catch (\Exception $e) {
            $errorMessage = "Error fetching Mandi rates: " . $e->getMessage();
            $this->error($errorMessage);
            Log::error($errorMessage);
        }
    }

}
