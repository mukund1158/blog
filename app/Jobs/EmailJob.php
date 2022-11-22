<?php

namespace App\Jobs;

use App\Mail\TestMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $to_mail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($to_mail)
    {
        $this->to_mail = $to_mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $details = [
            'title' => 'Mail form blog',
            'body' => 'Your profile has been updated in our database',
        ];

        Mail::to($this->to_mail)->send(new TestMail($details));
    }
}
