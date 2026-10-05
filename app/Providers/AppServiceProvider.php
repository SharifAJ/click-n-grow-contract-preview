<?php

namespace App\Providers;

use App\Models\FarmModel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * The boot() method is ideal for defining bindings and custom logic.
     */
    public function boot(): void
    {
        $this->app->make(RateLimiter::class)->for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });

        // Share the setting variable with all views
        View::composer('*', function ($view) {
            $view->with('setting',  Setting::firstOrNew([]));
        });

        /* // Custom route binding for 'farmId' that only resolves a Farm model if it belongs to the authenticated user, else throows error 404
        ** In routes whenever we write farmId, it will find that farm model instance and send it to controller, 
        ** we can then use the instance directly in controller arguments like this
         public function show(FarmModel $farm) {
            $farm is resolved using farm_id
            return response()->json($farm);
        }
        */
        Route::bind('farmId', function ($value) {
            return FarmModel::where('farm_id', $value)
                ->where('user_id', Auth::user()->id)
                ->firstOrFail();
        });
    }
}
