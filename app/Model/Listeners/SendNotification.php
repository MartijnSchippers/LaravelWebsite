<?php

namespace App\Model\Listeners;

use App\Model\Events\UserBoughtCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserBoughtCourse $event): void
    {
        //
    }
}
