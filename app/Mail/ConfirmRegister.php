<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmRegister extends Mailable
{
    use Queueable, SerializesModels;

    public $text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('XÁC NHẬN TÀI KHOẢN')->view('admin.mail.feedbackRegister');

        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()
                ->addTextHeader('Custom-Header', 'HeaderValue');
        });
    }
}
