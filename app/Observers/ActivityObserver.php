<?php

namespace App\Observers;

use Spatie\Activitylog\Models\Activity;

class ActivityObserver
{
    /**
     * Handle the Activity "created" event.
     */
    public function creating(Activity $activity): void
    {
        $activity->properties = $activity->properties->merge([
            'request_data' => [
                'url' => request()->fullUrl(),
                'previous_url' => url()->previous(),
            ],
            'device_data' => [
                'ip' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
                'referrer' => request()->header('referer'),
                'request_data' => request()->all(),
            ]
        ]);
    }

    /**
     * Handle the Activity "updated" event.
     */
    public function updated(Activity $activity): void
    {
        //
    }

    /**
     * Handle the Activity "deleted" event.
     */
    public function deleted(Activity $activity): void
    {
        //
    }

    /**
     * Handle the Activity "restored" event.
     */
    public function restored(Activity $activity): void
    {
        //
    }

    /**
     * Handle the Activity "force deleted" event.
     */
    public function forceDeleted(Activity $activity): void
    {
        //
    }
}
