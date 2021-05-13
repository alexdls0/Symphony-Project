<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use App\Entity\EstadoVideo;
use App\Entity\Video;
use App\Entity\Usuario;

class AccountPageAjaxController extends AbstractController {
    
    private $evRepo;
    private $vRepo;
    private $uRepo;
    private $serializer;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->evRepo = $entityManager->getRepository(EstadoVideo::class);
        $this->vRepo = $entityManager->getRepository(Video::class);
        $this->uRepo = $entityManager->getRepository(Usuario::class);
    }
    
    /**
     * Delete all user history
     * @Route("/ajax/account/delhistory", name="capsule_ajax_account_delh")
     * @Method({"GET"})
     */
    public function delallhistory(Request $request) {
        $uid = $this->getUser()->getId();
        
        //Ajax verification
        if (!empty($uid) && $request->isXmlHttpRequest()) {
            $allh = $this->evRepo->findAllByUser($uid);
        
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($allh as $his) {
                $entityManager->remove($his);
            }
            $entityManager->flush();
            $status = true;
        } else {
            $status = false;
        }
        
        return new JsonResponse(['status' => $status]);
    }
    
    /**
     * Delete single user history
     * @Route("/ajax/account/delsinglehistory", name="capsule_ajax_account_onedelh")
     * @Method({"GET"})
     */
    public function delsinglehistory(Request $request) {
        $uid = $this->getUser()->getId();
        $eid = $request->query->get('eid');
        
        //Ajax verification
        if (!empty($uid) && !empty($eid) && $request->isXmlHttpRequest()) {
            $oneh = $this->evRepo->findByUserId($eid,$uid);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($oneh);
            $entityManager->flush();
            $status = true;
        } else {
            $status = false;
        }
        
        return new JsonResponse(['status' => $status]);
    }
    
    /**
     * Delete all user favourites
     * @Route("/ajax/account/delfav", name="capsule_ajax_account_delf")
     * @Method({"GET"})
     */
    public function delallfav(Request $request) {
        $uid = $this->getUser();
        
        //Ajax verification
        if (!empty($uid) && $request->isXmlHttpRequest()) {
            $allfavs = $this->vRepo->findAllByUserFan($this->getUser()->getId());
            foreach ($allfavs as $video) {
                $uid->removeFavorito($video);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($uid);
            $entityManager->flush();
            $status = true;
        } else {
            $status = false;
        }
        
        return new JsonResponse(['status' => $status]);
    }
    
    /**
     * Delete all user favourites
     * @Route("/ajax/account/delsinglefav", name="capsule_ajax_account_onedelf")
     * @Method({"GET"})
     */
    public function delsinglefav(Request $request) {
        
        $vid = $request->query->get('vid');
        
        if (!empty($vid) && $request->isXmlHttpRequest()) {
            
            $video = $this->vRepo->find($vid);
            
            $uid = $this->getUser();
            $uid->removeFavorito($video);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($uid);
            $entityManager->flush();
            $status = true;
        } else {
            $status = false;
        }
        
        return new JsonResponse(['status' => $status]);
    }
    
}