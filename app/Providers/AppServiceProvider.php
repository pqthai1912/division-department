<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $routeDescriptions = config('app.routes_description');
            $currentRouteName = Route::currentRouteName();
            // write log when render view
            if (isset($routeDescriptions[$currentRouteName])) {
                $screenName = $routeDescriptions[$currentRouteName];
                Log::info(json_encode($view->getData() ?? []), [
                    'screen' => $screenName,
                ]);
            }
        });
    }
}
