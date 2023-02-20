<?php

namespace App\Listeners;

use App\Events\AskToEnrollCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class sendEnrollmentRequestToTrainer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AskToEnrollCourse $event)
    {
        $event->user->courses()->syncWithoutDetaching($event->courseId);
    }
}
