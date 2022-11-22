<?php

namespace App\Console;

use App\Jobs\DailyMail;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $userEmails = User::select('email')->get();
        foreach ($userEmails as $userEmail) {
            $schedule->job(new DailyMail($userEmail->email))->dailyAt('12:00');
        }

        // $userEmails = User::find(8)->only('email');
        // $schedule->job(new DailyMail($userEmails))->everyMinute();

        $schedule->command('queue:work --stop-when-empty')->dailyAt('12:00');
        $schedule->command('queue:retry all')->dailyAt('12:00');
        $schedule->command('telescope:prune')->daily();
        $schedule->command('auto:birthdaywish')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
