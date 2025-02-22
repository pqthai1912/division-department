<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

trait ObserverTrait
{
    public static function bootObserverTrait()
    {
        $routeDescriptions = config('app.routes_description');
        // supply while creating
        static::creating(function ($model) use ($routeDescriptions) {
            $model->created_date = now();
            $model->updated_date = now();
            $currentRouteName = Route::currentRouteName();
            // write log when render view
            if (isset($routeDescriptions[$currentRouteName])) {
                $screenName = $routeDescriptions[$currentRouteName];
                Log::info($model->toArray(), [
                    'screen' => $screenName,
                ]);
            }
            Log::info('Creating model data', [
                'data' => $model->toArray(),
            ]);
        });

        // supply while updating // ought to updating not updated (cause error infinite loop xbug)
        static::updating(function ($model) use ($routeDescriptions) {
            $model->updated_date = now();
            $currentRouteName = Route::currentRouteName();
            // write log when render view
            if (isset($routeDescriptions[$currentRouteName])) {
                $screenName = $routeDescriptions[$currentRouteName];
                Log::info($model->toArray(), [
                    'screen' => $screenName,
                ]);
            }
        });

    }

    // /**
    //  * Handle the User "restored" event.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @return void
    //  */
    // public function restored(User $user)
    // {
    //     //
    // }

    // /**
    //  * Handle the User "force deleted" event.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @return void
    //  */
    // public function forceDeleted(User $user)
    // {
    //     //
    // }
}
