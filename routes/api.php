<?php

use App\Http\Controllers\Api\AdvisoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Api\FarmController;
use App\Http\Controllers\Api\ImageAdvisory;
use App\Http\Controllers\Api\SatelliteDataController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FirebaseConnectionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebhookController;

Route::post('register', [ApiAuthController::class, 'register']);
Route::post('login', [ApiAuthController::class, 'login']);

//Webhook
Route::post('/satyukt-notify', [WebhookController::class, 'handleWebhook']);

Route::post('/webhook/razorpay', [CartController::class, 'handlePaymentSuccessWebhook']);


Route::prefix('reset-password')->group(function () {
    // Generate and send OTP
    Route::post('/otp', [ApiAuthController::class, 'sendOtp'])
        ->name('password.otp.generate')
        ->middleware('throttle:3,1'); // 3 attempts per minute

    // Verify OTP
    Route::post('/verify-otp', [ApiAuthController::class, 'verifyOtp'])
        ->name('password.otp.verify')
        ->middleware('throttle:5,1'); // 5 attempts per minute

    // Reset password with OTP
    Route::post('/reset', [ApiAuthController::class, 'resetWithOtp'])
        ->name('password.reset')
        ->middleware('throttle:3,1'); // 3 attempts per minute
});

// Protected Routes (authentication is required)
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/firebase-connection', [FirebaseConnectionController::class, 'index']);
    /* ------------------------------------------------------------------- FIREBASE ------------------------------------------------------------------- */
    Route::post('/store-fcm-token', [FirebaseConnectionController::class, 'storeToken']);


    //profile update
    Route::post('/profile-update', [ApiAuthController::class, 'profileUpdate']);
    Route::post('/delete-farmer', [ApiAuthController::class, 'farmerdelete']);
    Route::post('/user/language', [APIController::class, 'updateLanguage']);


    //mandi-rates
    Route::get('/mandi-rates', [APIController::class, 'mandi_rates']);
    Route::get('/get-state', [APIController::class, 'get_state']);
    Route::post('/get-city', [APIController::class, 'get_city']);

    //payment history
    Route::post('/payment-history', [APIController::class, 'payment_history']);

    Route::prefix('notifications')->group(function () {
        // Get unread notifications
        Route::get('/', [FarmController::class, 'showNotification']);
        Route::post('/clear/{id?}', [FarmController::class, 'clearNotifications']);
    });


    Route::post('logout', [ApiAuthController::class, 'logout']);  // Logout
    // Cart Management
    // Route::post('/cart/add', [CartController::class, 'addToCart']);
    // Route::post('/cart/remove', [CartController::class, 'removeFromCart']);
    Route::get('/cart', [CartController::class, 'getCart']);
    Route::post('/cart/sync', [CartController::class, 'syncCart']);
    // Payment Flow
    Route::post('/create-order', [CartController::class, 'createOrder'])->middleware('throttle:5,1'); // 5 attempts per minute;
    Route::post('/verify-payment', [CartController::class, 'verifyPayment']);

    Route::prefix('farms')->group(function () {
        //* Note: 'farmId' parameter is bound to the Farm model using Route::bind in AppServiceProvider.
        //* Note: 'farmId' binding ensures only farms belonging to the logged-in user are accessible.

        Route::get('/', [FarmController::class, 'index']); // Fetch all farms 
        Route::get('/{farmId}', [FarmController::class, 'show']); // Fetch a single farm by ID
        Route::post('/', [FarmController::class, 'store']); // Store a new farm
        Route::put('/{farmId}', [FarmController::class, 'update']); // Update a farm by ID
        Route::delete('/{farmId}', [FarmController::class, 'destroy']); // Delete a farm by ID

        Route::get('/{farmId}/satellite', [FarmController::class, 'showSatellite']);
        Route::get('/{farmId}/pest-and-disease', [FarmController::class, 'showPestAndDisease']);
        Route::get('/{farmId}/crop-calendar', [FarmController::class, 'showCropCalendar']);

        Route::get('/{farmId}/weather', [FarmController::class, 'showWeather']);
        Route::get('/crops/name-list', [FarmController::class, 'showCropList']);
        Route::get('/{farmId}/soil-report', [FarmController::class, 'showSoilReport']);
        Route::get('/{farmId}/irrigation-data', [FarmController::class, 'showIrrigationData']);

        Route::post('/{farmId}/update-image', [FarmController::class, 'storeOrUpdateFarmImage']);
    });


    Route::prefix('premium')->group(function () {
        Route::get('/service-master', [FarmController::class, 'showServiceMaster']);
        Route::get('/package-master', [FarmController::class, 'showPackageMaster']);
        Route::get('/package-service-master', [FarmController::class, 'showPackageServiceMaster']);
    });

    Route::prefix('advisories')->group(function () {
        Route::post('/{farmId}/upload', [AdvisoryController::class, 'handleUpload']);
        // Route::get('/{farmId}/{imgId}', [AdvisoryController::class, 'getAdvisory']);
        Route::delete('/{farmId}/{imgId}', [AdvisoryController::class, 'deleteSubmission']);

        Route::get('/{farmId}', [AdvisoryController::class, 'showAllAdvisoryResponses']);
        Route::get('/{farmId}/{imgId}', [AdvisoryController::class, 'showAdvisoryResponse']);
    });
});


Route::get('upload-image-advisory', [APIController::class, 'upload_image_advisory']); // this is not done beacuse it has upload image and dont handel in controller

// ==============================API Route ================================
Route::get('add-farm-details', [APIController::class, 'farm_detail']); //done
Route::get('edit-farm-details', [APIController::class, 'edit_detail']); //done
Route::get('show-farm-details', [APIController::class, 'farm_show']); //done
Route::get('delete-farm-details', [APIController::class, 'farm_delete']); //done
Route::get('add-satellite', [APIController::class, 'add_satellite']); //done
Route::get('farm-list', [APIController::class, 'farm_list']); //done
Route::get('crop-list', [APIController::class, 'crop_list']); //done
Route::get('retrieve-images', [APIController::class, 'retrieve_images']); //done - we are storing image in our db so no need to retrive from API

Route::get('crop-calendar', [APIController::class, 'crop_calendar']); //done
Route::get('pest-and-disease', [APIController::class, 'pest_and_disease']); //cron done 
Route::get('irrigation-data', [APIController::class, 'irrigation_data']); //cron done
Route::get('soil-report', [APIController::class, 'soil_report']); //cron done
Route::get('weather-data', [APIController::class, 'weather_data']); //cron done
Route::get('get-image-advisory-info', [APIController::class, 'image_advisory']); //cron done
// ==============================End API Route ================================

// api hit cron job - > response -> db save -> return response view