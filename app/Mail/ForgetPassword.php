<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use DB;

class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token= $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build(Request $request)
    {
        return $this->markdown('emails.forgetPasword')
            ->from('no-reply@ieso-incubator.org')
            -> Subject('Forget Password')
            ->with('token',$this->token);


    }
}
