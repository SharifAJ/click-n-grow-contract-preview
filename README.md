# How to Setup Project in Localhost

### Requirements on Your PC:

-   Composer 2
    ```sh
    composer --version
    ```
-   Laravel 11
    ```sh
    php artisan --version
    ```
-   PHP 8+
    ```sh
    php -v
    ```

---

### Steps:

1. Clone the repository:

```sh
git clone https://gitlab.com/kisansat/KisanSatWeb.git my-folder-name
```

2. Install Composer dependencies:

```sh
composer install
```

3. Install NPM dependencies:

```sh
npm install
```

4. Compile assets:

```sh
npm run dev
```

5. Serve the application:

```sh
php artisan serve
```

---

# Project Info

-   Laravel 11 , Breeze with Alpine.js
-   Sanctum
-   Tailwind CSS
-   [DaisyUI](https://daisyui.com/)
-   Local FontAwesome icons
-   Local 'Cantore One' font
-   Nunito Sans font from CDN

---

# Production Steps

1. Build assets:

```sh
npm run build
```

2. Optimize the application:

```sh
php artisan optimize:clear
```

3. We are using a CI/CD pipeline for deployment, so all files are directly transferred from the GitLab branch to the hosting. Remember to exclude the `vendor` folder from the pipeline code. Since Laravel 11 requires Composer 2 but Hostinger runs on Composer 1, there will be an issue. Always upload the `vendor` folder manually to the hosting by archiving and extracting the process.

4. If you encounter issues with CSS, JS, or any other files not loading properly, try manually uploading the `public` folder to the hosting server instead of relying on the CI/CD pipeline.

5. Run `queue:work` cron job and `queue:work --queue=satellite-data` cron job set on hosting
6. Run `php artisan schedule:run` cron job on hosting

---

# Pipeline Code for Reference

```yml
# DEPLOY STATIC FILES AND ALSO RUN MIGRATION AND SEEDERS TO THE DATABASE
stages:
    - deploy

deploy:
    stage: deploy
    script:
        # Set the environment to non-interactive for apt-get
        # - export DEBIAN_FRONTEND=noninteractive
        # Install necessary dependencies
        - apt-get update -y && apt-get install -y lftp ssh

        # Add SSH private key for authentication
        # - mkdir -p ~/.ssh
        # - echo "$SSH_PRIVATE_KEY" > ~/.ssh/id_rsa
        # - chmod 600 ~/.ssh/id_rsa
        # - ssh-keyscan -H $SSH_HOST >> ~/.ssh/known_hosts  # Add the host to known hosts to avoid SSH verification issues
        # Deploy files to Hostinger using lftp
        - lftp -c "set ssl:verify-certificate no; open -u $FTP_USERNAME,$FTP_PASSWORD $FTP_HOST; mirror -R --verbose --exclude=vendor --exclude=.env --exclude=.htaccess --only-newer ./ . --parallel=2"

        # Alternative Approach: Using Rsync (Better but Requires SSH)
        # If your Hostinger plan supports SSH and rsync, you can replace lftp with:
        # - rsync -avz --exclude='vendor' --exclude='.env' --exclude='.htaccess' --progress ./ $SSH_USER@$SSH_HOST:/home/u863528685/domains/yashamdemo.com/public_html/ekisansat

        # Run migrations and seeding
        # - ssh -o StrictHostKeyChecking=no $SSH_USER@$SSH_HOST "cd /home/u863528685/domains/yashamdemo.com/public_html/ekisansat && php artisan migrate --force && php artisan db:seed --force"
        # - ssh -o StrictHostKeyChecking=no $SSH_USER@$SSH_HOST "cd /home/u863528685/domains/yashamdemo.com/public_html/ekisansat && php artisan optimize:clear && php artisan migrate"

    environment:
        name: production
    only:
        - master # Trigger on the master branch
```

---

# Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   ├── DashboardController.php
│   │   ├── PageController.php
│   │   ├── ProfileController.php
│   │   └── Api/
│   ├── Middleware/
│   ├── Models/
│   ├── Providers/
│   ├── Services/
│   └── View/
resources/
├── css/
│   ├── app.css
├── js/
│   ├── app.js
├── views/
│   ├── layouts/
│   │   ├── app.blade.php
│   │   ├── guest.blade.php
│   │   ├── header.blade.php
│   │   ├── footer.blade.php
│   │   ├── navigation.blade.php
│   ├── pages/
│   │   ├── home.blade.php
│   │   ├── about.blade.php
│   │   ├── contact.blade.php
│   ├── dashboard/
│   │   ├── index.blade.php
│   ├── profile/
│   │   ├── edit.blade.php
│   │   ├── partials/
│   │   │   ├── delete-user-form.blade.php
│   │   │   ├── update-password-form.blade.php
│   │   │   ├── update-profile-information-form.blade.php
├── components/
│   ├── button.blade.php
│   ├── card.blade.php
│   ├── modal.blade.php
public/
├── build/
├── css/
├── js/
├── images/
├── storage/
└── index.php
```

# Steps I'm following during project

1. Update Composer and PHP to the latest versions.
2. Create a new Laravel project:

```sh
laravel new example-app
```

3. Install DaisyUI:

```sh
npm install -D daisyui
```

4. Select Breeze and configure:

-   Select Blade with Alpine.js
-   Enable Dark Mode support
-   Enable Vite

5. Download FontAwesome font:

```sh
npm install @fortawesome/fontawesome-free
```

-   Add the following line to your `resources/css/app.css` file:

```css
@import "@fortawesome/fontawesome-free/css/all.css";
```

-   Now you can use FontAwesome icons in your Blade templates like this:

```html
<i class="fas fa-home"></i>
```

6. Download the Google font "Cantore One" and unzip it to receive a `.ttf` file. Go to [Cloud Convert](https://cloudconvert.com/ttf-to-woff) and convert the `.ttf` file to `.woff` files. Add these files to the `public/fonts` folder. Then, import the font in your `app.css` file and set up the `@font-face` rule:

```css
@font-face {
    font-family: "Cantore One";
    src: url("/fonts/CantoreOne-Regular.woff") format("woff");
    font-weight: normal;
    font-style: normal;
}
```

---

### Installing Real-Time Communication Packages

composer require kreait/laravel-firebase
extension=sodium enable it in php.ini
check if its installed composer show kreait/laravel-firebase
if not then something wrong durent installation
composer remove kreait/laravel-firebase
then install again
composer require kreait/laravel-firebase
clear cache sometimes it also create problems
composer clearcache
composer show kreait/laravel-firebase
now it should show you the installed version

try again composer show kreait/laravel-firebase
php artisan vendor:publish --provider="Kreait\Laravel\Firebase\ServiceProvider" --tag=config

go to firebase, project setting, service accounts, new private key, generate key , a file will be downloaded.-me-2
rename the file to something easy, lets say, firebase-service-account.json
create storage/firebase/firebase-service-account.json
php artisan make:controller FirebaseConnectionController

Error encounter and solution

1. Invalid service account: The file at 'storage/app/firebase/firebase-service-account.json' is not readable  
   Solution: give full absolute path in env:
    <!-- You can find the database URL for your project at
     https://console.firebase.google.com/project/_/database -->
    FIREBASE_DATABASE_URL=https://kisansat-2026-default-rtdb.firebaseio.com
    FIREBASE_CREDENTIALS=C:\xampp\htdocs\kisansat-master\storage\firebase\firebase-service-account.json
2. FCM send failed after 3 attempts: The registration token is not a valid FCM registration token :

## Sanctum API setup for token based authentication

-   We want both web and mobile app users to share the same authentication system (same database tables, same users) but with different authentication methods:

Web: Session-based authentication (cookies, redirects, Blade views).
Mobile App: Token-based authentication (API endpoints, JSON responses).

-   The login and registration logic is implemented twice: once for web-based authentication and once for API authentication. The ApiAuthController handles API-based login, registration, and logout, while the same logic for web authentication exists in Auth controllers. Similarly, authentication routes are defined in both auth.php (for web) and api.php (for API-based authentication).

-   Copy routes from `auth.php` to `api.php` to create APIs. (copy-paste, don't do cut-paste)
-   In Laravel 11, you need to manually create the `api.php` file and then register it in the `bootstrap/app.php` file:

```php
web: __DIR__.'/../routes/web.php',
api: __DIR__.'/../routes/api.php', // Add this line
```

-   Install Sanctum for token-based authentication: (In older version of laravel you needed to run these commands: composer require laravel/sanctum | php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider" | php artisan migrate)

    We will use laravel 11 method:

    ```sh
    php artisan install:api
    ```

    Check your database. You should have a `personal_access_tokens` table.

-   Add the following in the `bootstrap/app.php` file:

    ```php
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api([
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ```

-   Add these lines to your `.env` file: (this is required in old laravel, i dont know if latest version need it or not, but i have included)

    ```
    SANCTUM_STATEFUL_DOMAINS=http://127.0.0.1:8000
    SESSION_DOMAIN=http://127.0.0.1:8000
    ```

### Rate Limiting

Rate limiting is a security and performance feature that helps protect your application from abuse, overuse, and potential attacks. To add rate limiting to your application, update the `AppServiceProvider` as follows:

```php
    public function boot(): void
    {
        $this->app->make(RateLimiter::class)->for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
```

### Add HasApiTokens in User Model

To enable API token authentication, you need to add the `HasApiTokens` trait to your `User` model. Open the `User` model file and update it as follows:

```php
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
}
```

---

## Tailwind Configuration

```js
import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import daisyui from "daisyui";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.js", // Ensure Tailwind works with JS files
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [forms, daisyui],
};
```

## Laravel Cache for OTP storage

Laravel's built-in caching system (e.g., Redis, file, database) is ideal for storing OTPs temporarily.

**Benefits:**

-   **Fast and Efficient:** Faster than querying the database.
-   **Temporary Storage:** Automatic expiration of cache entries.
-   **Built-In Support:** No need for third-party tools.

Redis is better but we will use file system, because hostinger shared environement doesnt support redis.

#### Create a 6-digit numeric OTP generator service

1. Create app/Services/OTPService.php
2. Add the following code to the `OTPService.php` file:

```php
namespace App\Services;

/**
 * Class OTPService
 *
 * This class provides functionality to generate a One-Time Password (OTP) of a specified length.
 */
class OTPService
{
    public function generate(int $length = 6): string
    {
        return str_pad(random_int(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
    }
}
```

3. Register the service in the `composer.json` file:

```json
"autoload": {
    "files": [
        "app/Helpers/otp_helper.php"
    ]
}
```

4. Create a helper function (optional but recommended):

```php
// app/Helpers/otp_helper.php
if (!function_exists('generate_otp')) {
    function generate_otp(int $length = 6): string
    {
        return app(\App\Services\OTPService::class)->generate($length);
    }
}
```

4. Run `composer dump-autoload` to update the autoload files.
5. Verification Test

```php
php artisan tinker
>>> generate_otp()
=> "429573" (example output)
```

#### Configure database cache to store OTPs with 15-minute expiration

We can't chose redis, memcached, etc. because hostinger shared environement doesnt support them. So we will use database cache as its better than file system.

1. Create cache table:

```sh
php artisan cache:table
php artisan migrate
```

2. Set cache driver to database in .env file:

```env
CACHE_DRIVER=database
```

3. Update app/Services/OTPService.php:

```php
 public function storeOTP(string $mobile, string $otp): void
    {
        // Store OTP in database cache for 15 minutes
        Cache::put(
            $this->getCacheKey($mobile),
            $otp,
            now()->addMinutes(15)
        );
    }

    protected function getCacheKey(string $mobile): string
    {
        // Unique cache key per mobile number
        return 'otp_verification_' . $mobile;
    }
```

4. Update helper function app/Helpers/otp_helper.php:

```php
if (!function_exists('store_otp')) {
    function store_otp(string $mobile, string $otp): void
    {
        // Helper to store OTP in cache using mobile number
        app(\App\Services\OTPService::class)->storeOTP($mobile, $otp);
    }
}
```

5. Verification Test

```php
php artisan tinker
>>> store_otp('9876543210', '123456');
=> null
>>> Cache::get('otp_verification_9876543210');
=> "123456" (should return null after 15 minutes)
```

Also check the database table `cache` to see if the OTP is stored correctly with expiration time 15 minutes.
SELECT \* FROM cache WHERE key = 'otp_verification_9876543210';

#### Create an API endpoint to verify OTPs

1.

```sh
php artisan make:controller Auth/OTPController
```

2. Add this code to app/Http/Controllers/Auth/OTPController.php

```php
class OTPController extends Controller
{
    protected $otpService;

    // Dependency injection of our OTP service
    public function __construct(OTPService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function verify(Request $request)
    {
        // Step 1: Validate incoming request data
        $validated = $request->validate([
            'mobile' => 'required|string|min:10|max:15',
            'otp' => 'required|string|size:6'
        ]);

        // Step 2: Clean and format mobile number
        $mobile = trim($request->mobile);
        $enteredOTP = trim($request->otp);

        // Step 3: Attempt to retrieve stored OTP from cache
        $storedOTP = Cache::get($this->otpService->getCacheKey($mobile));

        // Step 4: Compare OTPs (case-sensitive)
        if ($storedOTP && $enteredOTP === $storedOTP) {
            // Step 5a: OTP matched - process successful verification
            return response()->json([
                'message' => 'OTP verified successfully',
                'token' => $this->generateSanctumToken($mobile)
            ]);
        }

        // Step 5b: OTP mismatch - throw validation error
        throw ValidationException::withMessages([
            'otp' => 'Invalid or expired OTP'
        ]);
    }

    protected function generateSanctumToken($mobile)
    {
        // Step 6: Find or create user based on mobile number
        $user = \App\Models\User::firstOrCreate(
            ['mobile_number' => $mobile],
            ['name' => 'Farmer'] // Default name
        );

        // Step 7: Generate Sanctum API token
        return $user->createToken('otp-token')->plainTextToken;
    }
}
```

3. api.php

```php
Route::post('/verify-otp', [OTPController::class, 'verify']);
```

4. Testing, you can test in postman or thunderclient
   Success test:

```sh
curl -X POST http://your-app.test/api/verify-otp \
     -H "Content-Type: application/json" \
     -d '{"mobile": "9876543210", "otp": "123456"}'
```

Failure test:

```sh
curl -X POST http://your-app.test/api/verify-otp \
     -H "Content-Type: application/json" \
     -d '{"mobile": "9876543210", "otp": "wrong"}'
```

#### Simulate sending OTP via SMS using Laravel Notifications (log channel for now).

## Centralize validation rules for both API token and web views session

---

# Log Table

## Asynchronous Logging Implementation

1. Create Logging Job:
   php artisan make:job LogApiRequest

---

# Farm Service Payment API Documentation

Base URL
https://ekisansatdemo.com/api

Authentication
Header: Authorization: Bearer <USER_TOKEN>

1. Cart Management
   Add Item to Cart
   Endpoint: POST /cart/add
   Headers:

Content-Type: application/json
Authorization: Bearer <USER_TOKEN>
Request Body:

```json
{
    "farm_id": 123,
    "item_id": 1,
    "item_type": "service" // or "package"
}
```

Success Response:
{
"message": "Item added to cart"
}

2. Remove Item from Cart
   Endpoint: POST /cart/remove
   Headers: Same as above

Request Body:

```json
{
    "farm_id": 123,
    "item_id": 1,
    "item_type": "service"
}
```

Success Response:

{
"message": "Item removed from cart"
}

3. Get Cart Contents
   Endpoint: GET /cart
   Headers: Same as above

Success Response:

{
"data": [
{
"id": 1,
"item_name": "Soil Analysis",
"price": 499.00,
"type": "service",
"quantity": 2
}
]
}

2. Payment Flow
   Create Payment Order
   Endpoint: POST /create-order
   Headers: Same as above

Request Body:

{
"farm_id": 123
}
Success Response:

{
"order_id": "order_XXXXXXXXXXXXXX",
"amount": 99800,
"currency": "INR",
"razorpay_key": "rzp_test_XXXXXXXXXXXX"
}

4. Payment Verification (Webhook)
   Webhook Endpoint: POST /webhook/razorpay

5. Get Subscriptions
   Endpoint: GET /subscriptions?farm_id=123
   Headers: Same as above

Success Response:

{
"data": [
{
"id": 1,
"service": "Soil Analysis",
"expires_at": "2025-12-31",
"status": "active"
}
]
}
Testing Credentials
Razorpay Test Cards
Card Number CVV Expiry Result
4111 1111 1111 1111 123 12/30 Success
4000 0000 0000 0002 123 12/30 Failure
Sample User Token
eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.xxxxx.xxxxx

Notes
Always include farm*id in requests.
Handle 401 errors by refreshing the token.
Configure the webhook URL in the Razorpay dashboard.
Test mode: ₹1. Production: Replace rzp_test* with your live key.

SYNC CART request

---
