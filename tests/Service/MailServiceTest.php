<?php
namespace App\Tests\Service;

use App\Service\Mail;
use App\Tests\Includes\BaseController;

class MailServiceTest extends BaseController
{

    public function testMailSend()
    {
        $loader = new \Twig_Loader_Filesystem('templates/');
        $twigenv = new \Twig_Environment($loader);

        $transport = (new \Swift_SmtpTransport(getenv('APP_MAIL_HOST'), getenv('APP_MAIL_PORT')))
            ->setUsername(getenv('APP_MAIL_USERNAME'))
            ->setPassword(getenv('APP_MAIL_PASSWORD'))
            ->setAuthMode('login');

        $swiftmailer = new \Swift_Mailer($transport);

        $mail = new Mail($swiftmailer, $twigenv);
        $return = $mail->send(getenv('APP_MAIL_TO'), 'Unit Mail Test', 'mail/test.html.twig', ['date' => new \DateTime()]);
        $this->assertTrue($return);
    }

    /**
     * @expectedException \Swift_RfcComplianceException
     */
    public function testMailExecption()
    {
        $loader = new \Twig_Loader_Filesystem('templates/');
        $twigenv = new \Twig_Environment($loader);

        $transport = (new \Swift_SmtpTransport(getenv('APP_MAIL_HOST'), getenv('APP_MAIL_PORT')))
            ->setUsername(getenv('APP_MAIL_USERNAME'))
            ->setPassword(getenv('APP_MAIL_PASSWORD'))
            ->setAuthMode('login');

        $swiftmailer = new \Swift_Mailer($transport);

        $mail = new Mail($swiftmailer, $twigenv);
        $return = $mail->send(getenv('erze654fz@localhost'), 'Unit Mail Test', 'mail/test.html.twig', ['date' => new \DateTime()]);
    }
}
?>