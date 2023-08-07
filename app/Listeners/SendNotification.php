<?php

namespace App\Listeners;

use App\Events\UserBoughtCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;

class SendNotification implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
        dd('This listener is constructed');
    }

    /**
     * Handle the event.
     */
    public function handle(UserBoughtCourse $event): void
    {
        Log::info('Event handled successfully!');
        DB::table('admin_notifications')->insert(['message' => 'A user bought a new course']);
    }
}
