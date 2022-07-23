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
    public $view = "emails.order-received-md";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $view = '')
    {
        $this->data = $data;

        if($view != '') $this->view = $view;
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
        ->markdown($this->view)->with('data', $this->data);
    }
}
