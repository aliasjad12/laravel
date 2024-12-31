<?php

// app/Console/Commands/SendDailyReport.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\DailyReportMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendDailyReport extends Command
{
    // The name and signature of the console command
    protected $signature = 'report:send-daily';

    // The console command description
    protected $description = 'Send daily email reports to all users';

    // Execute the console command
    public function handle()
    {
        // Get all users (or you can apply any specific logic)
        $users = User::all();

        foreach ($users as $user) {
            // Send the daily report email
            Mail::to($user->email)->send(new DailyReportMail($user));
        }

        $this->info('Daily reports sent successfully!');
    }
}

