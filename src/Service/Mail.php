<?php
namespace App\Service;


class Mail
{
    private  $mailer;
    private $templating;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function send($to, $subject, $content, $params)
    {
        $mail = (new \Swift_Message($subject))
            ->setFrom('contact@gtl-studio.com')
            ->setTo($to)
            ->setBody(
                $this->templating->render(
                    $content,
                    $params
                ),
                'text/html'
            )
        ;


        if($this->mailer->send($mail))
            return true;
        else
            return false;
    }
}
