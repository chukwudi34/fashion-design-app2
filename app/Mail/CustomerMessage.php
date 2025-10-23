<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $subject;
    public $content;

    public function __construct(Customer $customer, $subject, $content)
    {
        $this->customer = $customer;
        $this->subject = $subject;
        $this->content = $content;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.customer-message')
                    ->with([
                        'customer' => $this->customer,
                        'subject' => $this->subject,
                        'content' => $this->content,
                    ]);
    }
}