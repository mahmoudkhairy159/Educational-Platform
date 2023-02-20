<?php

namespace App\Providers;

use App\Providers\AskToEnrollCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class endEnrollmentRequestToTrainer
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
     * @param  AskToEnrollCourse  $event
     * @return void
     */
    public function handle(AskToEnrollCourse $event)
    {
        //
    }
}
