<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailContact extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    public function __construct($data)
    {
        //
        $this->data = $data;
    }


    public function build()
    {
        return $this->from('kq909981@gmail.com')
            ->view('mail.contact')
            ->subject('Liên hệ NQK BookStore');
    }
}
