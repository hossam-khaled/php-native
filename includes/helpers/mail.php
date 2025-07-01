<?php

if (!function_exists('send_mail') ) {
    function send_mail(array $mails,string $subject,string $massage):bool  {
        if(config('mail.protocal') == 'smtp') {
            ini_set('SMTP', config('mail.smtp_domain'));
            ini_set('smtp_port', config('mail.smtp_port'));
        }
        $headers = 'MIME-Version: 1.0' ."\r\n";
        $headers .= 'Content-Type: text/html;charset=UTF-8' ."\r\n";
        $headers .= 'FROM: '. config('mail.FROM_ADDRESS') ."\r\n";

        return mail($mails[0],$subject,$massage,$headers);
    }
}

