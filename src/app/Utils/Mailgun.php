<?php
namespace Utils;

use PHPMailer;

class Mailgun extends \Prefab
{

    private $opts;

    public function __construct($opts)
    {
        $this->opts = $opts;
    }

    public function alertMail($to, $subject, $message, $isHtml = true, $from = null)
    {
        $mailer = $this->getMailer();
        if ($isHtml) {
            $mailer->msgHTML($message);
        } else {
            $mailer->body($message);
        }

        $i = 0;
        if (is_array($to) && count($to) > 0) {
            foreach ($to as $t) {
                if ($i == 0) {
                    $mailer->addAddress($t, '');
                } else {
                    $mailer->addCC($t, '');
                }
                $i++;
            }
        } elseif (is_string($to)) {
            $mailer->addAddress($to, '');
        }

        if (is_array($from)) {
            if(trim($from[0]) != ''){
                $mailer->addReplyTo($from[0], $from[1]);
            }
        } elseif (is_string($from)) {
            if(trim($from) != ''){
                $mailer->addReplyTo($from, '');
            }
        }

        $mailer->Subject = $subject;
        $mailer->Body = $message;

        if ($mailer->send()) {
            return true;
        }

        return false;

    }

    public function send($from, $to, $subject, $message, $isHtml = false, $bccs = []){

        // We use 2 mailers here,
        // because BCC-ing yourself when your email is set as the reply-to
        // address, causes the email to go to spam box

        // $mailer goes to the customer
        // $selfMailer goes to yourself, and any other people who need copying in

        $mailer = $this->getMailer();
        $selfMailer = $this->getMailer();

        $hasFromEmail = false;
        $hasToEmail = false;

        if ($isHtml) {
            $mailer->msgHTML($message);
            $selfMailer->msgHTML($message);
        } else {
            $mailer->body($message);
            $selfMailer->body($message);
        }

        if (is_array($from)) {
            if(trim($from[0]) != ''){
                $mailer->addReplyTo($from[0], $from[1]);
                $selfMailer->addAddress($from[0], $from[1]);
                $hasFromEmail = true;
            }
        } elseif (is_string($from)) {
            if(trim($from) != ''){
                $mailer->addReplyTo($from, '');
                $selfMailer->addAddress($from, '');
                $hasFromEmail = true;
            }
        }

        if (is_array($to)) {
            if(trim($to[0]) != ''){
                $mailer->addAddress($to[0], $to[1]);
                $hasToEmail = true;
            }
        } elseif (is_string($to)) {
            if(trim($to) != ''){
                $mailer->addAddress($to, '');
                $hasToEmail = true;
            }
        }

        $mailer->Subject = $subject;
        $mailer->Body = $message;

        $selfMailer->Subject = $subject . ' [COPY]';
        $selfMailer->Body = $message;

        $mailerSent = $mailer->send();

        if (is_array($bccs) && count($bccs) > 0) {
            $i = 0;
            foreach ($bccs as $bcc) {
                if (is_array($bcc)) {
                    if ($i == 0 && !$hasFromEmail) {
                        $selfMailer->addAddress($bcc[0], $bcc[1]);
                    } else {
                        $selfMailer->addCC($bcc[0], $bcc[1]);
                    }
                } elseif (is_string($bcc)) {
                    if ($i == 0 && !$hasFromEmail) {
                        $selfMailer->addAddress($bcc, '');
                    } else {
                        $selfMailer->addCC($bcc, '');
                    }
                }
                $i++;
            }
        }
        $selfMailer->send();

        return true;
    }

    private function getMailer()
    {
        $mailer = new PHPMailer;
        $mailer->isSMTP();
        $mailer->Host = $this->opts['server'];
        $mailer->SMTPAuth = true;
        $mailer->Username = $this->opts['username'];
        $mailer->Password = $this->opts['password'];
        $mailer->Port = $this->opts['port'];
        $mailer->SMTPSecure = 'tls';
        $mailer->addCustomHeader(
            'List-Unsubscribe',
            '<unsubscribe@>, <https://>'
        );
        //TODO: Fix these
        $mailer->addCustomHeader(
            'X-Mailgun-Variables',
            '{"environment": "'.K_ENV.'"}'
        );

        $mailer->setFrom($this->opts['sender'], '');

        return $mailer;
    }

}
