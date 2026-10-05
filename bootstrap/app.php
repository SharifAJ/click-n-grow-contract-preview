<?php

use App\Console\Commands\ImageAdvisoryCron;
use App\Http\Middleware\LanguageMiddleware;
use App\Jobs\FetchSatelliteData;
use App\Listeners\TrackSatyuktApiRequests;
use App\Services\ApiHelperService;
use App\Services\SatelliteApiService;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php', // Ensure this line is present
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    // ->withEvents([
    //     RequestSending::class => [
    //         TrackSatyuktApiRequests::class,
    //     ],
    // ])

    ->withSchedule(function (Schedule $schedule) {
    
        $apiHelper = new ApiHelperService();

        $schedule->call(function () {
            Log::info("Running Scheduler"); //testing purpose only
        })->daily();
        // $schedule->job(new FetchSatelliteData($apiHelper))->cron('0 0 */5 * *'); // Run once every 5 days at midnight IST
        // // $schedule->job(new FetchSatelliteData($apiHelper))->everyMinute();
    
        // $schedule->command('advisory:poll')
        //     ->daily()
        //     ->runInBackground()
        //     ->withoutOverlapping();
    
        // $schedule->command('weather:fetch')
        //     ->daily()
        //     ->runInBackground()
        //     ->withoutOverlapping();
    
        // $schedule->command('pest:fetch')
        //     ->weekly()
        //     ->runInBackground()
        //     ->withoutOverlapping();
    
        // $schedule->command('irrigation:fetch')
        //     ->weekly()
        //     ->runInBackground()
        //     ->withoutOverlapping();
    
        // $schedule->command('soil-report:fetch')
        //     ->quarterly()
        //     ->runInBackground()
        //     ->withoutOverlapping();
    
        // $schedule->command('calendar:fetch')
        //     ->daily()
        //     ->runInBackground()
        //     ->withoutOverlapping();
    
        // ! Below code is for testing purpose only, uncomment above code with current frequencies
        // $schedule->job(new FetchSatelliteData($apiHelper))->daily();

        // $schedule->command('advisory:poll')
        //     ->daily()
        //     ->runInBackground()
        //     ->withoutOverlapping();

        // $schedule->command('weather:fetch')
        //     ->daily()
        //     ->runInBackground()
        //     ->withoutOverlapping();

        // $schedule->command('pest:fetch')
        //     ->daily()
        //     ->runInBackground()
        //     ->withoutOverlapping();

        // $schedule->command('irrigation:fetch')
        //     ->daily()
        //     ->runInBackground()
        //     ->withoutOverlapping();

        // $schedule->command('soil-report:fetch')
        //     // ->everyFiveMinutes()
        //     // ->everyMinute()
        //     ->daily()
        //     ->runInBackground()
        //     ->withoutOverlapping();

        // $schedule->command('calendar:fetch')
        //     ->daily()
        //     ->runInBackground()
        //     ->withoutOverlapping();

        // $schedule->command('mandirate:fetch')
        //     ->daily()
        //     ->runInBackground()
        //     ->withoutOverlapping();


        // $schedule->command('subscription:status')
        //     ->daily()
        //     ->runInBackground()
        //     ->withoutOverlapping();
            
        // $schedule->command('crop-list:fetch')->monthly();
    
        // $schedule->command('queue:restart')->daily()->runInBackground();
        
        
        
        //this chagne for the job run in after 12 hour 
        $schedule->job(new FetchSatelliteData($apiHelper))
        ->twiceDaily(0, 12);
        
        // $schedule->job(new FetchSatelliteData($apiHelper))
        //  ->everyMinute();


        $schedule->command('advisory:poll')
            ->twiceDaily(0, 12)
            ->runInBackground()
            ->withoutOverlapping();
        
        $schedule->command('weather:fetch')
            ->twiceDaily(0, 12)
            ->runInBackground()
            ->withoutOverlapping();
        
        $schedule->command('pest:fetch')
            ->twiceDaily(0, 12)
            ->runInBackground()
            ->withoutOverlapping();
        
        $schedule->command('irrigation:fetch')
            ->twiceDaily(0, 12)
            ->runInBackground()
            ->withoutOverlapping();
        
        $schedule->command('soil-report:fetch')
            ->twiceDaily(0, 12)
            ->runInBackground()
            ->withoutOverlapping();
        
        $schedule->command('calendar:fetch')
            ->twiceDaily(0, 12)
            ->runInBackground()
            ->withoutOverlapping();
        
        $schedule->command('mandirate:fetch')
            ->twiceDaily(0, 12)
            ->runInBackground()
            ->withoutOverlapping();
        
        $schedule->command('subscription:status')
            ->twiceDaily(0, 12)
            ->runInBackground()
            ->withoutOverlapping();
        
        // This remains monthly
        $schedule->command('crop-list:fetch')
            ->weekly();
        
        $schedule->command('queue:restart')
            ->twiceDaily(0, 12)
            ->runInBackground();
        
    })



    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*', headers: Request::HEADER_X_FORWARDED_PROTO);

        $middleware->api([
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // \App\Http\Middleware\ForceJsonResponse::class,
        ]);
        
        $middleware->web(append: [
            LanguageMiddleware::class,
        ]);
    })



    ->withExceptions(function (Exceptions $exceptions) {
        // Helper methods as closures
        $getStatusCode = function (Throwable $exception): int {
            return match (true) {
                $exception instanceof ValidationException => 422,
                $exception instanceof NotFoundHttpException => 404,
                $exception instanceof HttpExceptionInterface => $exception->getStatusCode(),
                default => 500
            };
        };

        $getErrorMessage = function (Throwable $exception): string {
            return match (true) {
                $exception instanceof NotFoundHttpException => 'Resource not found',
                $exception instanceof ValidationException => 'Validation failed',
                default => $exception->getMessage() ?: 'Server Error'
            };
        };

        // Force JSON for API routes
        $exceptions->render(function (Throwable $e, Request $request) use ($getStatusCode, $getErrorMessage) {
            if ($request->is('api/*')) {
                $statusCode = $getStatusCode($e);
                $response = [
                    'success' => false,
                    'message' => $getErrorMessage($e),
                    'errors' => []
                ];

                // Add validation errors if applicable
                if ($e instanceof ValidationException) {
                    $response['errors'] = $e->errors();
                }

                return response()->json($response, $statusCode);
            }
        });

        // Customize 404 for API routes
        $exceptions->render(function (NotFoundHttpException $e, Request $request) use ($getStatusCode, $getErrorMessage) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => $getErrorMessage($e),
                ], $getStatusCode($e));
            }
        });
    })
    ->create();

/**DOCS
 * 
 * Manually Dispatch the Job
 * php artisan queue:work
 * php artisan tinker
 * \App\Jobs\FetchSatelliteData::dispatch();
 */
