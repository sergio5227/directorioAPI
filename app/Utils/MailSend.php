<?php

namespace App\Utils;

use Mail;

class MailSend {

    public function sendMailPro($data,$blade = 'confirmation', $subject = 'Confirm account') {
        Mail::send(
            $blade,
            $data,
            function ($message) use ($data,$subject) {
                $to = $data['email'];
                $message->to($to)->subject($subject);
            }
        );
        return count(Mail::failures());
    }
}
