<?php

use App\Http\Controllers\Api\ApiUsageController;
use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FarmMonitoringController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TradingEnquiryController;
use App\Http\Controllers\Web\ContactUsController;
use App\Http\Controllers\Web\BlogPostController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\FarmerController;
use App\Http\Controllers\Web\PackageMasterController;
use App\Http\Controllers\Web\PaymentController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\FarmController;
use App\Http\Controllers\Web\ServiceMasterController;
use App\Http\Controllers\Web\FarmerSubscriptionController;
use App\Http\Controllers\Web\SettingController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractFarmingController;
use App\Http\Controllers\ContractFarming\CropController;
use App\Http\Controllers\ContractFarming\EnquiryController;
use App\Http\Controllers\ContractFarming\BusinessAssociateController;
use App\Http\Controllers\ContractFarming\FPOController;
use App\Http\Controllers\ContractFarming\FarmersController;
use App\Http\Controllers\ExpertVisitRegistrationController;



// Admin login/logout routes (no middleware)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthenticatedSessionController::class, 'create'])
        ->name('admin.login');

    Route::post('/login', [AdminAuthenticatedSessionController::class, 'store']);

    Route::post('/logout', [AdminAuthenticatedSessionController::class, 'destroy'])
        ->name('admin.logout');
});

// for lanuages support ✅ Change language route
Route::get('change-language/{lang}', function ($lang) {
    Session::put('applocale', $lang);
    return redirect()->back();
})->name('change.language');


// Admin dashboard route (protected by auth:admin middleware)
Route::middleware(['auth:admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'home'])->name('dashboard');

    // ============For Farmer Controller================
    Route::resource('farmer', FarmerController::class);
    Route::get('/get-farmer-data/{id}', [FarmerController::class, 'farmer_data']);
    Route::delete('/farmer/{id}/restore', [FarmerController::class, 'farmer_restore'])->name('farmer.restore');
    Route::post('/change-farmer-status', [FarmerController::class, 'farmer_status']);


    // ============For Farmer Controller================
    Route::resource('subscription', FarmerSubscriptionController::class);
    Route::get('/user-subscription-show/{id}', [FarmerSubscriptionController::class, 'user_show'])->name('user_subscription.show');
    Route::post('/farmer-subscription_get-farmer-data', [FarmerSubscriptionController::class, 'farmer_subscription_get_data']);
    Route::post('/get-farm-area', [FarmerSubscriptionController::class, 'get_farm_area']);
    Route::get('/get-package-data-from-master', [FarmerSubscriptionController::class, 'get_package_data']);
    Route::get('/get-service-data-from-master', [FarmerSubscriptionController::class, 'get_service_data']);
    Route::get('/get-freeservice-data-from-master', [FarmerSubscriptionController::class, 'get_freeservice_data']);
    Route::POST('/get-packageduration-data-from-master', [FarmerSubscriptionController::class, 'get_packageduration_data']);
    Route::POST('/get-serviceduration-data-from-master', [FarmerSubscriptionController::class, 'get_serviceduration_data']);
    Route::POST('/get-freeduration-data-from-master', [FarmerSubscriptionController::class, 'get_freeduration_data']);
    Route::post('/change-farm_subscriptions-status', [FarmerSubscriptionController::class, 'farm_subscriptions']);
    Route::post('/dupplicate-subscritption-data', [FarmerSubscriptionController::class, 'package_dupplicate']);
    Route::post('/existing-subscription', [FarmerSubscriptionController::class, 'existing_subscription']);
    Route::post('/checkpackage_service_name', [FarmerSubscriptionController::class, 'checkpackage_service_name']);
    Route::post('/premiumvalue', [FarmerSubscriptionController::class, 'premiumvalue']);


    // ============For farm Controller================
    Route::resource('addfarm', FarmController::class);
    Route::delete('/farm/{id}/restore', [FarmController::class, 'farm_restore'])->name('addfarm.restore');
    // Route::get('/farm-monitoring-api-error-log/{farmid}', [FarmController::class, 'farm_monitoring_api_error_log'])->name('monitoring-api_error_log');
    Route::get('/get-farm-data/{id}', [FarmController::class, 'farm_data']);
    Route::post('/change-farm-status', [FarmController::class, 'farm_status']);
    Route::get('/farm-monitoring/{farm_id}/{crop_name}', [FarmController::class, 'farm_monitoring']);
    Route::post('/get-irrigation-data', [FarmController::class, 'irrigation_data']);
    Route::post('/get_city_list', [FarmController::class, 'get_city_list']);
    Route::get('/mandi-rates', [FarmController::class, 'fetchMandiRates'])->name('mandi.rates');


    // ============For payment Controller================
    Route::resource('payment', PaymentController::class);
    Route::post('payment/create', [PaymentController::class, 'create'])->name('paymentcreate');



    Route::get('/service-index', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/logs-index', [ApiUsageController::class, 'log_index'])->name('logs.index');

    // ============For farmMonitoring Controller================
    Route::resource('/monitoring', FarmMonitoringController::class);
    Route::get('/farm-monitoring-api-error-log/{farmid}', [FarmMonitoringController::class, 'farm_monitoring_api_error_log'])->name('monitoring-api_error_log');


    Route::get('/sidebar-links', [FarmMonitoringController::class, 'getSidebarLinks']);
    Route::get('/page-content/{id}', [FarmMonitoringController::class, 'getPageContent']);

    // ============For ServiceMaster Controller================
    Route::resource('setting/servicemaster', ServiceMasterController::class);
    Route::post('/change-service_master-status', [ServiceMasterController::class, 'serv_master_status']);

    // ============For packageMaster Controller================
    Route::resource('setting/packagemaster', PackageMasterController::class);
    Route::post('/change-package_master-status', [PackageMasterController::class, 'package_master_status']);

    // ============For contact us Controller================
    Route::resource('dashboard/contact-us', ContactUsController::class);
    Route::resource('admin/blogs', BlogPostController::class)
        ->except(['show']);

    /* ---------------------------------------------------------------- GENERAL SETTING --------------------------------------------------------------- */
    Route::get('/settings/application', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/settings/update', [SettingController::class, 'update'])->name('setting.update');
});

// User-specific routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Guest-specific routes
Route::get('/', [PageController::class, 'contract'])->name('home');
Route::get('/service/{service}', [PageController::class, 'showSingleServicePage'])->name('services.show');
Route::view('/grievance-redressal', 'pages/grievance-redressal')->name('grievance-redressal');
Route::view('/privacy-policy', 'pages/privacy-policy')->name('privacy-policy');
Route::view('/refund-policy', 'pages/refund-policy')->name('refund-policy');
Route::view('/terms-and-conditions', 'pages/terms-and-conditions')->name('terms-and-conditions');
Route::view('/about', 'pages/about')->name('about');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/trading-and-export', [PageController::class, 'tradingExport'])->name('trading-export');
Route::get('/trading-enquiry-form', [TradingEnquiryController::class, 'create'])->name('trading-enquiry-form');
Route::post('/trading-enquiry-form', [TradingEnquiryController::class, 'store'])
    ->middleware('throttle:8,1')
    ->name('trading-enquiry-form.store');
Route::get('/expert-visit-registration', [ExpertVisitRegistrationController::class, 'create'])
    ->name('expert-visit-registration');
Route::post('/expert-visit-registration', [ExpertVisitRegistrationController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('expert-visit-registration.store');
Route::post('/expert-visit-registration/payment/verify', [ExpertVisitRegistrationController::class, 'verifyPayment'])
    ->middleware('throttle:10,1')
    ->name('expert-visit-registration.payment.verify');
// Show contact form
Route::get('/contact-us', [ContactUsController::class, 'create'])->name('contact-us');
// Route::view('/contact-us', 'pages/contact-us')->name('contact-us');
Route::get('/contract-farming-medicinal-plants', [PageController::class, 'contract'])->name('contract');
 // Public submission of Contract Farming enquiries
Route::post('/contract-farming-enquiry', [EnquiryController::class, 'store'])
    ->name('contract_farming.enquiry.public.store');



// Disable CSRF protection for this specific endpoint
Route::post('/satyukt_notify', [WebhookController::class, 'handleWebhook'])
    ->withoutMiddleware(['csrf']); // Completely removes session/CSRF


Route::prefix('contract-farming')->middleware('auth:admin')->group(function () {

    Route::get('/', [ContractFarmingController::class, 'index'])->name('contract_farming.index');
    Route::get('/create', [ContractFarmingController::class, 'create'])->name('contract_farming.create');
    Route::get('/reports', [ContractFarmingController::class, 'reports'])->name('contract_farming.reports');

    // Crop resource routes
    Route::resource('crops', CropController::class)
        ->names([
            'index' => 'contract_farming.crops.index',
            'create' => 'contract_farming.crops.create',
            'store' => 'contract_farming.crops.store',
            'show' => 'contract_farming.crops.show',
            'edit' => 'contract_farming.crops.edit',
            'update' => 'contract_farming.crops.update',
            'destroy' => 'contract_farming.crops.destroy',
        ]);

    // Enquiry, business associate, farmers, FPO
    Route::resource('enquiries', EnquiryController::class)->names('contract_farming.enquiry');
    Route::resource('business_associate', BusinessAssociateController::class)->names('contract_farming.business_associate');
    Route::resource('farmers', FarmersController::class)->names('contract_farming.farmers');
    Route::resource('fpo', FPOController::class)->names('contract_farming.fpo');

    // Enquiry store routes
    Route::post('/enquiry/business', [BusinessAssociateController::class, 'store'])->name('enquiry.business.store');
    Route::post('/enquiry/farmer', [FarmersController::class, 'store'])->name('enquiry.farmer.store');
    Route::post('/enquiry/fpo', [FpoController::class, 'store'])->name('enquiry.fpo.store');
});




require __DIR__ . '/auth.php';


/* DOCS */
/*
? When you use Route::resource, Laravel automatically creates multiple routes for the specified controller, mapping them to the appropriate controller methods.

For example, the line:
Route::resource('farmer', FarmerController::class);

generates the following routes:

* GET /farmer - index method (list all farmers)
* GET /farmer/create - create method (show farm to create a new farmer)
* POST /farmer - store method (store a new farmer)
* GET /farmer/{id} - show method (show a specific farmer)
* GET /farmer/{id}/edit - edit method (show farm to edit a specific farmer)
* PUT/PATCH /farmer/{id} - update method (update a specific farmer)
* DELETE /farmer/{id} - destroy method (delete a specific farmer)
*/
