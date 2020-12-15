<?php

namespace App\Providers;

use App\Providers\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendMailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        try {
            $data = [
                'name' => $event->user['first_name'] . ' ' . $event->user['last_name'],
                'email' => $event->user['email']
            ];
            if($event->template == 'emails.login') {
                $ip = $_SERVER['REMOTE_ADDR'];
                $details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}"));
                $data['country'] = $details->geoplugin_countryName;
            }
            Mail::send($event->template, ['data1' => $data], function ($message) use ($data, $event) {   
                $message->to($data['email'], )->subject($event->subject)->from('info@iprotect-mena.com');
            });
        } catch (Exception $e) {
        }
    }
}
