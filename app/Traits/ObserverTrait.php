<?php

namespace App\Traits;


trait ObserverTrait
{
    public static function bootObserverTrait()
    {
        // supply while creating
        static::creating(function ($model) {
            $model->created_date = now();
            $model->updated_date = now();
        });

        // supply while updating // ought to updating not updated (cause error infinite loop xbug)
        static::updating(function ($model) {
            $model->updated_date = now();
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
