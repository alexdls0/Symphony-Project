<?php

namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\ValidationService;
use App\Service\EncryptionService;
use App\Service\MailManager;
use App\Service\CaptchaService;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use \DateInterval;
use \DateTime;

class RegistrationController extends AbstractController
{
    
    private $userRepository;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->userRepository = $entityManager->getRepository(Usuario::class);
    }
    
    
    /**
     * @Route("/register", name="capsule_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, CaptchaService $captcha, LoginFormAuthenticator $authenticator, MailManager $mail): Response
    {
        //If user is logged, go to /
        if ($this->getUser() != null) {
            return $this->redirectToRoute('capsule_dashboard');
        }
        
        //Initial data
        $promo = $request->query->get('promo');
        $dberror = null;
        $user = new Usuario();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Initial sets
            $user->setPassword($form->get('plainPassword')->getData());
            $user->setType(0);
            $user->setActivo(0);
            $user->setFechaalta(new \DateTime());

            //Bad form or bad captcha
            if (!$this->validateForm($user)) {
                $dberror = "Form integrity violation.";
            } else if (!$captcha->validate($request->request->get('g-recaptcha-response'))) {
                $dberror = "Captcha validation error.";
            } else {
                // encode the plain password
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
                
                //2 months promotion
                if ($promo == 1) {
                    $date = new DateTime('-5 seconds');
                    $interval = new DateInterval('P2M'); //Adding months
                    $date->add($interval);
                    $user->setFechapremium($date);
                }
                
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
    
                //Mandar correo de activación
                $mail->sendActivationEmail($user);
                return $this->redirectToRoute('capsule_log');
                
            }
            
        }

        //Result
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'dberror' => $dberror,
            'promo' => $promo
        ]);
    }
    
    /**
     * Activates a user account
     * @Route("/account/activate", name="account_activation")
     */
    public function activate(Request $req, EncryptionService $crypt, ValidationService $validate): Response {
        $status = false;
        //Get params
        $email = $req->query->get('email');
        $uname = $req->query->get('urlname');

        //Check if valid base64
        if ($validate::validateCrypt($email) && $validate::validateCrypt($uname)) {

            //Decrypt
            $email = $crypt->decrypt($email);
            $uname = $crypt->decrypt($uname);

            //Find user
            $user = $this->userRepository->findUserByUsernameAndEmail($uname, $email); //We will use genuine data for validation
            //Find if user ok
            if (!empty($user)) {
                $user->setActivo(1);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                $status = true;
            }
        }

        return $this->redirectToRoute('capsule_log', ['activated' => $status]);
    }
    
    public function validateForm($user) {
        $valid = new ValidationService();
        $status = true;

        if (!$valid->validateEmail($user->getCorreo()) ||
                !$valid->validateUsername($user->getApodo()) ||
                !$valid->validatePassword($user->getPassword())) {

            $status = false;
        }
        return $status;
    }
}
