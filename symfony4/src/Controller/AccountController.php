<?php

namespace App\Controller;

use App\Entity\Video;
use App\Entity\Pago;
use App\Entity\EstadoVideo;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\MailManager;
use App\Form\EditAccountFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class AccountController extends AbstractController
{
    
    private $vRepo;
    private $evRepo;
    private $pagoRepo;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->vRepo = $entityManager->getRepository(Video::class);
        $this->evRepo = $entityManager->getRepository(EstadoVideo::class);
        $this->pagoRepo = $entityManager->getRepository(Pago::class);
    }
    
    
    /**
     * @Route("/account", name="capsule_account")
     */
    public function indexAccount(Request $request, MailManager $mail): Response {
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $maxItems = 4;
        $dbstatus = null;
        $account = $this->getUser();
        $form = $this->createForm(EditAccountFormType::class, $account)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Saves user object
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($account);
            $entityManager->flush();
            
            //Sends password change if specified
            if ($form->get('sendPassword')->getData()) {
                $mail->sendPasswordChangeEmail($this->getUser());
            }
            $dbstatus = true;
        }
        
        $premium = [];
        $now = time();
        
        //Premium user message and days
        if ($account->getFechapremium()) {
            $premiumuser = strtotime($account->getFechapremium()->format('Y-m-d H:i:s'));
            $diff = $premiumuser - $now;
            $temp = $diff/86400; // 60 sec/min*60 min/hr*24 hr/day=86400 sec/day
            // days
            $days = floor($temp);
            
            $premium['days'] = $days;
            if ($diff <= 0) {
                $premium['status'] = 'No';
            } else {
                $premium['status'] = 'Yes';
            }
        } else {
            $premium['days'] = null;
            $premium['status'] = 'No';
        }
        
        /**
         * Adding history data in /account
         * Deprecate findAllByUser()
         **/
        $vs = $this->evRepo->findAllByUserPaged($this->getUser()->getId(),1,$maxItems);
        
        /**
         * Adding billing data in /account
         * $mask_cc represents the credit card with a mask
         * Deprecate findAllByUserdate()
         **/
        $ps = $this->pagoRepo->findAllByUserDatePaged($this->getUser()->getId(),1,$maxItems);
        
        return $this->render('account/account.html.twig', [
                'accountForm' => $form->createView(),
                'dbstatus' => $dbstatus,
                'premium' => $premium,
                'videostats' => $vs,
                'payments' => $ps
                //User is app.user in twig
            ]);
    }
    
    /**
     * @Route("/account/favourites/{page}", name="capsule_account_favs",requirements={"page"="\d+"})
     */
    public function accountFavs($page = 1, Request $req): Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $limitPerPage = 4;
        
        $favs = $this->vRepo->findAllByUserFanPaged($this->getUser()->getId(),$page,$limitPerPage);
        return $this->render('account/favourites.html.twig', [
                'favoritos' => $favs,
                //Paging
                'maxPages' => ceil($favs->count() / $limitPerPage),
                'currentPage' => $page,
                'currentPath' => $req->attributes->get('_route'),
                'isAjaxPaginator' => false
            ]);
    }
    
    /**
     * @Route("/account/history/{page}", name="capsule_account_history",requirements={"page"="\d+"})
     */
    public function accountHistory($page = 1, Request $req): Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $limitPerPage = 4;
        
        $vs = $this->evRepo->findAllByUserPaged($this->getUser()->getId(),$page,$limitPerPage);
        return $this->render('account/history.html.twig', [
                'videostats' => $vs,
                'page' => 'history',
                //Paging
                'maxPages' => ceil($vs->count() / $limitPerPage),
                'currentPage' => $page,
                'currentPath' => $req->attributes->get('_route'),
                'isAjaxPaginator' => false
            
            ]);
    }
    
    /**
     * @Route("/account/billing/{page}", name="capsule_account_billing",requirements={"page"="\d+"})
     */
    public function accountBilling($page = 1, Request $req): Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $limitPerPage = 4;
        
        $ps = $this->pagoRepo->findAllByUserDatePaged($this->getUser()->getId(),$page,$limitPerPage);
        return $this->render('account/billing.html.twig', [
                'payments' => $ps,
                //Paging
                'maxPages' => ceil($ps->count() / $limitPerPage),
                'currentPage' => $page,
                'currentPath' => $req->attributes->get('_route'),
                'isAjaxPaginator' => false
            ]);
    }
    
    /**
     * @Route("/account/deactivate", name="capsule_account_deactivate")
     */
    public function accountDeactivate() {
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->setActivo(0);
        
        $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        
        return $this->redirectToRoute('app_logout');

    }
    
    /**
     * @Route("/account/mailtest", name="capsule_mail_tester")
     */
    public function mailtest() {
        return $this->renderView('emails/newsletter-prueba.html.twig');
    }
    
}
