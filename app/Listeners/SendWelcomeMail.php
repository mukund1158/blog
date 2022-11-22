<?php

namespace App\Listeners;

use App\Mail\TestMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMail implements ShouldQueue
{
    // public $connection = 'redis';

    public $queue = 'listeners';

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
    public function handle($event)
    {
        $user = $event->users;
        App::setlocale($user->lang);
        Log::info('sendwelcomemail');
        $details = [
            'user' => $user,
            'title' => 'Mail form blog',
        ];

        Mail::to($user->email)->send(new TestMail($details));
    }
}
