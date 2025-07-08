<?php

/**
 * Sends an email using the specified parameters.
 *
 * @param array $mails      An array of recipient email addresses. Only the first address is used.
 * @param string $subject   The subject of the email.
 * @param string $massage   The HTML message body of the email.
 * @return bool             Returns true if the mail was successfully accepted for delivery, false otherwise.
 *
 * The function uses SMTP settings from the configuration if 'mail.protocal' is set to 'smtp'.
 * The email is sent as HTML with UTF-8 encoding.
 */
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

