<?php

namespace App\Observers;

use App\Models\studentClass;

class studentClassObserver
{
    /**
     * Handle the studentClass "created" event.
     */
    public function created(studentClass $studentClass): void
    {
        //
    }

    /**
     * Handle the studentClass "updated" event.
     */
    public function updated(studentClass $studentClass): void
    {
        //
    }

    /**
     * Handle the studentClass "deleted" event.
     */
    public function deleted(studentClass $studentClass): void
    {
        $studentClass->Student()->delete();
    }

    /**
     * Handle the studentClass "restored" event.
     */
    public function restored(studentClass $studentClass): void
    {
        //
    }

    /**
     * Handle the studentClass "force deleted" event.
     */
    public function forceDeleted(studentClass $studentClass): void
    {
        //
    }
}
