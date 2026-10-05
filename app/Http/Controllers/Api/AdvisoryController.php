<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessAdvisorySubmission;
use App\Models\AdvisorySubmission;
use App\Models\CropListModel;
use App\Models\FarmModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdvisoryController extends Controller
{
    public function handleUpload(Request $request, FarmModel $farm)
    {
        $farmId = $farm->farm_id;
        Log::info('Request received', [
            'headers' => $request->headers->all(),
            'body' => $request->all(),
            'files' => $request->file(),
        ]);

        try {
            Log::info("inside try block");
            // Step 1: Check if the user has reached the 5-submission limit
            if (!AdvisorySubmission::canUpload($farmId)) {
                return response()->json(['error' => 'Maximum 5 submissions allowed'], 403);
            }

            // Step 2: Validate user inputs
            $validated = $request->validate([
                'image' => 'required|file|mimes:jpg,png,jpeg|max:5120',
                'audio' => 'nullable|file|mimes:mp3,wav,aac|max:5120',
                // 'croptype' => 'required|exists:crop_list,crop_name',
                'croptype' => 'required',
                'comment' => 'nullable|string|max:500'
            ]);

            // Generate img_id
            $lastImgId = AdvisorySubmission::where('farm_id', $farmId)->max('img_id');
            $imgId = $lastImgId ? $lastImgId + 1 : 1;
            Log::info("img_id: $imgId");

            // Step 3: Process files and create submission in a database transaction
            $submission = DB::transaction(function () use ($request, $farmId, $validated, $imgId) {
                Log::info("inside transaction");

                // Generate filenames
                // $baseName = $validated['croptype'] . '_' . $farmId . '_' . now()->format('dmYHis');
                $baseName = $validated['croptype'] . '_' . $farmId . '_' . $imgId . '_' . now()->format('dmY');

                // Store files
                $imageName = $this->storeFile($request->file('image'), 'advisories/images', $baseName);
                $audioName = $request->hasFile('audio')
                    ? $this->storeFile($request->file('audio'), 'advisories/audio', $baseName)
                    : null;

                // Create submission
                return AdvisorySubmission::create([
                    'farm_id' => $farmId,
                    'img_id' => $imgId, // Use the generated img_id
                    'image_file_name' => $imageName,
                    'audio_file_name' => $audioName,
                    'croptype' => $validated['croptype'],
                    'comment' => $validated['comment']
                ]);
            });
            Log::info("Submission creates in db");

            // Step 4: Dispatch a job to send data to the third-party API
            dispatch(new ProcessAdvisorySubmission($submission));
            Log::info(" ProcessAdvisorySubmission Job dispatched ");

            return response()->json([
                'message' => 'Submission received',
                'submission_id' => $submission->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    private function storeFile($file, $path, $baseName)
    {
        $extension = $file->extension();
        $filename = "{$baseName}.{$extension}";
        $file->storeAs($path, $filename, 'public');
        return $filename;
    }

    // public function getAdvisory($farmId, $imgId)
    // {
    //     Log::info("inside getAdvisory " . $farmId . " " . $imgId);
    //     // Step 1: Fetch the submission with its associated response
    //     $submission = AdvisorySubmission::with('response')
    //         ->where(['farm_id' => $farmId, 'img_id' => $imgId])
    //         ->firstOrFail();

    //     // Step 2: Return the response as JSON
    //     return response()->json([
    //         'status' => $submission->status,
    //         'image_url' => Storage::url("advisories/images/{$submission->image_file_name}"),
    //         'audio_url' => $submission->audio_file_name
    //             ? Storage::url("advisories/audio/{$submission->audio_file_name}")
    //             : null,
    //         'analysis' => $submission->response?->analysis_results,
    //         'submitted_at' => $submission->created_at,
    //         'responded_at' => $submission->response?->responded_at
    //     ]);
    // }

    public function deleteSubmission(FarmModel $farm, $imgId)
    {
        $farmId = $farm->farm_id;

        // Step 1: Find the submission
        $submission = AdvisorySubmission::with('response')
            ->where(['farm_id' => $farmId, 'img_id' => $imgId])
            ->firstOrFail();

        // Step 2: Call the third-party API to delete the image
        $apiUrl = config('services.satyukt_api.url') . "/delete_img?farm_id={$farmId}&img_name={$submission->image_file_name}";

        try {
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                $responseData = $response->json();

                if (isset($responseData['Deleted'])) {
                    // Step 3: Delete associated files from local storage
                    Storage::disk('public')->delete([
                        "advisories/images/{$submission->image_file_name}",
                        "advisories/audio/{$submission->audio_file_name}"
                    ]);

                    // Step 4: Delete the submission from the database
                    $submission->delete();

                    return response()->json(['message' => 'Submission deleted successfully']);
                }

                return response()->json(['error' => 'Failed to delete image from third-party API'], 500);
            }

            return response()->json(['error' => 'Third-party API request failed'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'API request failed: ' . $e->getMessage()], 500);
        }
    }



    /**
     * Show all advisory responses for a given farm ID.
     *
     * @param int $farmId
     * @return \Illuminate\Http\JsonResponse
     */
    // public function showAllAdvisoryResponses(FarmModel $farm)
    // {
    //     $farmId = $farm->farm_id;
    //     // Get all advisory submissions for the specified farm, including related farm and advisory response data.
    //     $advisoryData = AdvisorySubmission::with('response')
    //         ->where('farm_id', $farmId)
    //         ->get();

    //     return response()->json([
    //         'status'  => true,
    //         'message' => 'Advisory responses retrieved for farm ID: ' . $farmId,
    //         'data'    => $advisoryData,
    //     ], 200);
    // }
    public function showAllAdvisoryResponses(FarmModel $farm)
    {
        $farmId = $farm->farm_id;

        // Get all advisory submissions for the specified farm, including related farm and advisory response data.
        $advisoryData = AdvisorySubmission::with('response')
            ->where('farm_id', $farmId)
            ->get()
            ->map(function ($submission) {
                // Generate image URL
                if ($submission->image_file_name) {
                    $submission->image_url = asset('storage/advisories/images/' . $submission->image_file_name);
                } else {
                    $submission->image_url = null;
                }

                // Generate audio URL
                if ($submission->audio_file_name) {
                    $submission->audio_url = asset('storage/advisories/audio/' . $submission->audio_file_name);
                } else {
                    $submission->audio_url = null;
                }

                // Remove the original file name fields (optional)
                unset($submission->image_file_name);
                unset($submission->audio_file_name);

                return $submission;
            });

        return response()->json([
            'status'  => true,
            'message' => 'Advisory responses retrieved for farm ID: ' . $farmId,
            'data'    => $advisoryData
        ], 200);
    }
    /**
     * Show a specific advisory response filtered by farm ID and image ID.
     *
     * @param int $farmId
     * @param int $imgId
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAdvisoryResponse(FarmModel $farm, $imgId)
    {
        $farmId = $farm->farm_id;
        // Find a single advisory submission based on farm_id and img_id
        $advisorySubmission = AdvisorySubmission::with('response')
            ->where('farm_id', $farmId)
            ->where('img_id', $imgId)
            ->first();

        if (!$advisorySubmission) {
            return response()->json([
                'status'  => false,
                'message' => "No advisory response found for farm ID: $farmId and image ID: $imgId",
                'data'    => null,
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Advisory response retrieved for farm ID: ' . $farmId . ' and image ID: ' . $imgId,
            'data'    => $advisorySubmission,
        ], 200);
    }
}
