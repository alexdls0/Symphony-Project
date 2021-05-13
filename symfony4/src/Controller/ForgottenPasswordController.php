<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\EncryptionService;
use App\Service\MailManager;
use App\Service\ValidationService;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\ResetPassFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ForgottenPasswordController extends Controller {

    private $userRepository;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->userRepository = $entityManager->getRepository(Usuario::class);
    }

    /**
     * Responds to an ajax petition if a user exists or not.
     * 
     * @Route("/ajax/account/recoverpassword", name="ajax_recoverpassword")
     * @Method({"POST"})
     */
    public function recoverpassword(Request $req, MailManager $mail) {
        $email = $req->request->get('email');

        $account = $this->userRepository->findUserByEmail($email);
        if (!empty($account) && $req->isXmlHttpRequest()) {
            $dbemail = $account->getCorreo();
            $mail->sendPasswordChangeEmail($account);
            $found = true;
        } else {
            $dbemail = null;
            $found = false;
        }
        
        $response = new JsonResponse(['found' => $found]);
        return $response;
    }

    /**
     * Helps a user reset their password if the email and token (email + timestamp) are legit
     * 
     * @Route("/account/forgotten", name="forgottenpassword")
     */
    public function forgotpasshandler(Request $req, UserPasswordEncoderInterface $passwordEncoder, ValidationService $validate, EncryptionService $crypt) {
        //Get params
        $email = $req->query->get('email');
        $token = $req->query->get('token');
        $uname = $req->query->get('urlname');

        //Check if valid base64
        if ($validate::validateCrypt($email) &&
                $validate::validateCrypt($token) &&
                $validate::validateCrypt($uname)) {

            //Decrypt
            $email = $crypt->decrypt($email);
            $token = $crypt->decrypt($token);
            $uname = $crypt->decrypt($uname);

            //Find user
            $user = $this->userRepository->findUserByUsernameAndEmail($uname, $email); //We will use genuine data for validation
            //Find if user ok
            if (!empty($user)) {
                $form = $this->createForm(ResetPassFormType::class, $user);
                $form->handleRequest($req);

                //Time OK
                if ($form->isSubmitted() && $form->isValid() && $validate::validateTokenTime($token)) {
                    $user->setPassword(
                            $passwordEncoder->encodePassword(
                                    $user, $form->get('plainPassword')->getData()
                            )
                    );

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($user);
                    $entityManager->flush();

                    //return if change OK
                    return $this->redirectToRoute('capsule_log', ['passreset' => true]);
                }

                //Typical form cycle
                return $this->render('security/recoverpass.html.twig', [
                            'recoveryForm' => $form->createView(),
                            'email' => $crypt->encrypt($email),
                            'token' => $crypt->encrypt($token),
                            'urlname' => $crypt->encrypt($uname)
                ]);
            }
            //Bad user, tampered. Login.
            return $this->redirectToRoute('capsule_log');
        } else {
            //No valid tokens, go login
            return $this->redirectToRoute('capsule_log');
        }
    }

}
