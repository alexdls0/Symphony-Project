<?php
namespace App\Service;

use App\Service\EncryptionService;

class MailManager {
    
    private $mailer;
    private $twig;
    
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating) {
        $this->mailer = $mailer;
        $this->twig = $templating;
    }
    
    /**
     * Sends account activation link to user
     */
    public function sendActivationEmail(\App\Entity\Usuario $user) {
        $userMail = $user->getCorreo();
        $userName = $user->getApodo();
        $crypt = new EncryptionService();
        $urlName = $crypt->encrypt($userName);
        $mailcrypt = $crypt->encrypt($userMail);

        $this->send($userMail, 'emails/activation.html.twig', ['username' => $userName, 'urlname' => $urlName, 'email' => $mailcrypt], 'Capsule account activation');
    }

    /**
     * Sends password change notice to user inbox
     */
    public function sendPasswordChangeEmail(\App\Entity\Usuario $user) {

        $userMail = $user->getCorreo();
        $userName = $user->getApodo();

        $crypt = new EncryptionService();
        $token = $crypt->encrypt(time());
        $urlName = $crypt->encrypt($userName);
        $mailcrypt = $crypt->encrypt($userMail);

        $this->send($userMail, 'emails/password.html.twig', ['username' => $userName, 'urlname' => $urlName, 'email' => $mailcrypt, 'token' => $token], 'Capsule password refresh');
    }
    
    /**
     * Sends payment confirmed email
     */
    public function sendPaymentEmail($email,\App\Entity\Pago $pago) {
        $this->send($email, 'emails/payment.html.twig', ['pago' => $pago], 'Capsule premium service');
    }
    
    
    /**
     * Sends emails
     * 
     * @param type $mailadd
     * @param type $temproute
     * @param type $params
     * @param type $title
     */
    private function send($mailadd, $temproute, $params, $title) {
        $body = $this->twig->render($temproute, $params);
        $message = (new \Swift_Message($title))
                ->setFrom('noreply@capsule.me')
                ->setTo($mailadd)
                ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }
}