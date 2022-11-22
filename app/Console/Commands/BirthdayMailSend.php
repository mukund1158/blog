<?php

namespace App\Console\Commands;

use App\Mail\BirthdayWish;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class BirthdayMailSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:birthdaywish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::whereMonth('birthday', date('m'))
            ->whereDay('birthday', date('d'))
            ->get();
        if ($users->count() > 0) {
            foreach ($users as $user) {
                Mail::to($user->email)->send(new BirthdayWish($user));
            }
        }
    }
}
