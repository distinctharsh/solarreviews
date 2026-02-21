<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolarEnquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $enquiry;

    public function __construct($enquiry)
    {
        $this->enquiry = $enquiry;
    }

    public function build()
    {
        return $this->subject('New Solar Enquiry - ' . $this->enquiry->name)
                    ->view('emails.solar-enquiry')
                    ->with([
                        'enquiry' => $this->enquiry,
                    ]);
    }
}
