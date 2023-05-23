<?php

namespace App\Listeners;

use App\Events\AskToEnrollCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

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
        $event->user->courses()->sync($event->courseId);
        DB::update('UPDATE course_user SET status =NULL WHERE user_id=' . $event->userId . ' AND course_id= ' . $event->courseId);
    }
}
