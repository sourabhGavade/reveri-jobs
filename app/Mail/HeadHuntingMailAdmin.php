<?php

namespace App\Mail;
use Auth;
use App\CareerLevel;
use App\FunctionalArea;
use App\Industry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HeadHuntingMailAdmin extends Mailable
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
        // dd($this->data->email_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->data->job_profile_name=CareerLevel::where('id',$this->data->job_profile)->first()->career_level;
        $this->data->functional_area_name=FunctionalArea::where('id',$this->data->functional_area)->first()->functional_area;
        $this->data->industry_name=Industry::where('id',$this->data->industry)->first()->industry;
        return $this->from(config('mail.from.address'),config('mail.from.name'))
        ->to(config('mail.recieve_to.address'),config('mail.recieve_to.name'))
        ->subject('Mail For HeadHunting.')
        ->view('emails.head_hunting_admin')
        ->with([
            'data' => $this->data
        ]);
    }
}
