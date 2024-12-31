<?php

// app/Mail/DailyReportMail.php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class DailyReportMail extends Mailable
{
    use SerializesModels;

    public $user;

    // Constructor to pass user data
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // Build the message
    public function build()
    {
        return $this->subject('Your Daily Report')
                    ->view('emails.daily_report');  // You can create the view to format the email content
    }
}

