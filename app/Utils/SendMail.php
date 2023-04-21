<?php
namespace App\Utils;
use Mail;

class Notifications {
    public function __construct() {
        return "construct function was initialized.";
    }
    public function create() {
        // create notification
        // send email
        // return output
    }

    public function sendMail($data){
        Mail::send(
            'contact',
            ['name' => $data->name, 'email' => $data->email, 'subject' => $data->comentario],
            function ($message) {
                $to = 'sergio.cruz@people-media.com.mx';
                $message->to($to)->subject('Contact Message');
            }
        );
        return count(Mail::failures());
    }
}
