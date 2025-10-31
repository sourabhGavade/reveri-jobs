<?php

namespace App\Mail;
use Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RazorpayPaymentMail extends Mailable
{

    use Queueable,
        SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        // dd($data);die;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        return $this->from(config('mail.from.address'),config('mail.from.name'))
        ->to(Auth::guard('company')->user()->email,config('mail.recieve_to.name'))
        ->subject('Payment Status For ReveriJobs.')
        ->view('emails.send_payment_status')
        ->with([
            'data' => $this->data
        ]);
    }
}
