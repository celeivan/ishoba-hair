<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOrderNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reference = $this->data['reference'];
        $subject = "IShoba Hair Order - $reference";        
        return $this->from(env('MAIL_FROM_ADDRESS'), 'iShoba Hair Order Notification')
        ->subject($subject)
        ->markdown('emails.order-received-md')->with('data', $this->data);
    }
}
