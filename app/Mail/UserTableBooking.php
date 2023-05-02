<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserTableBooking extends Mailable
{
    use Queueable, SerializesModels;

      public $data=null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
    }

    public function build()
    {
        return $this->subject(Settings()->order_email_subject)
                    ->view('mailable.admin')->with('data',$this->data);
    }
}
