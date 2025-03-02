<?php

namespace App\Observers;

use App\Models\Archive;

class ArchiveObserver
{
    /**
     * Handle the Archive "created" event.
     */
    public function created(Archive $archive): void
    {

    }

    /**
     * Handle the Archive "updated" event.
     */
    public function updated(Archive $archive): void
    {
        //
    }

    /**
     * Handle the Archive "deleted" event.
     */
    public function deleted(Archive $archive): void
    {
        //
    }

    /**
     * Handle the Archive "restored" event.
     */
    public function restored(Archive $archive): void
    {
        //
    }

    /**
     * Handle the Archive "force deleted" event.
     */
    public function forceDeleted(Archive $archive): void
    {
        //
    }
}
