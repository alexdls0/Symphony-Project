<?php

namespace App\Controller;

use App\Entity\Pago;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\ValidationService;
use App\Service\EncryptionService;
use App\Service\MailManager;
use App\Service\CaptchaService;
use App\Form\PaymentFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

use \DateTime;
use \DateInterval;

class PaymentController extends AbstractController
{
    
    private $userRepository;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->userRepository = $entityManager->getRepository(Usuario::class);
    }
    
    /**
     * @Route("/payment", name="capsule_pay")
     */
    public function payindex(Request $request, MailManager $mail): Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY'); //Usuario debe estar logged in
        
        $pago = new Pago();
        //Obtiene el precio base de .env
        $baseprice = getenv('CAPSULE_BASE_PRICE');
        //Crea el formulario
        $form = $this->createForm(PaymentFormType::class, $pago);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid() && is_numeric($baseprice)) {

            //Sets iniciales básicos
            $pago->setFecha(new \DateTime());
            $pago->setCuentausuario($user);
            
            //Calcula precio
            $months = $form->get('plan')->getData();
            $total = $baseprice * $months;
            $perctotal = ($months / 100) * $total;
            $grandtotal = $total - $perctotal;
            $rounded = number_format($grandtotal, 2, '.', '');
            $pago->setImporte($rounded);

            //Añade meses a fecha
            $date = new DateTime('-5 seconds'); //Impide fallo de "no es tiempo válido"
            $interval = new DateInterval('P' . $months . 'M'); //P1M
            $date->add($interval);
            
            //Guardar fecha nueva de premium
            $user->setFechapremium($date);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pago);
            $entityManager->flush();
                
            //Enviar mail
            $mail->sendPaymentEmail($form->get('correo')->getData(),$pago);
            return $this->redirectToRoute('capsule_pay_confirm');
                
        }
        
        $userpremium = $user->getFechapremium();
        $now = new DateTime();
        //Si el usuario ya es premium, renderiza un mensaje.
        //Si no, se renderiza el formulario.
        if ($userpremium > $now) {
            return $this->render('payment/already.html.twig');
        } else {
            return $this->render('payment/payment.html.twig', [
                'paymentForm' => $form->createView()
            ]);
        }

    }
    
    /**
     * @Route("/payment/confirmed", name="capsule_pay_confirm")
     */
    public function payconfirm(): Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('payment/confirmed.html.twig');
    }
    
    
    
}
