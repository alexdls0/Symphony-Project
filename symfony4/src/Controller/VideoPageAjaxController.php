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
use App\Service\MathService;
use \DateTime;

class VideoPageAjaxController extends AbstractController {
    
    private $evRepo;
    private $vRepo;
    private $uRepo;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->evRepo = $entityManager->getRepository(EstadoVideo::class);
        $this->vRepo = $entityManager->getRepository(Video::class);
        $this->uRepo = $entityManager->getRepository(Usuario::class);
    }
    
    //Tiempos
    /**
     * Gets the user requested video time
     * @Route("/ajax/video/videotime", name="capsule_ajax_videotime")
     */
    public function videotimequery(Request $req) {
        //Video id
        $vid = $req->query->get('vid');
        //User id
        $uid = $this->getUser()->getId();

        if ($req->isXmlHttpRequest() && $vid && $uid) {
            //Query that gets video stats by uid and vid.
            $videodata = $this->evRepo->findByUserVideoStatus($vid,$uid);
            $return = $videodata->getTiempo();
        } else {
            $return = null;
        }
        return new JsonResponse(['tiempo' => $return]);
    }
    
    /**
     * Sets video stats per user
     * @Route("/ajax/video/savevideotime", name="capsule_ajax_savevideotime")
     */
    public function videotimesave(Request $req, MathService $math) {
        //Video id
        $vid = $req->query->get('vid');
        //User id
        $uid = $this->getUser()->getId();
        
        //Extra params
        $currentTime = $req->query->get('current');
        $totalTime = $req->query->get('total');
        
        if (is_numeric($currentTime) && is_numeric($totalTime) && $req->isXmlHttpRequest()) {
            
            $currentTime = floor($currentTime);
            $totalTime = floor($totalTime);            
            $percent = floor($math->percent($currentTime, $totalTime));
            
            //Query that gets video stats by uid and vid.
            $videodata = $this->evRepo->findByUserVideoStatus($vid,$uid);
            if (empty($videodata)) {
                //Create table if it doesnt exist
                //Check if the video exists
                $video = $this->vRepo->find($vid);
                $user = $this->getUser();
                
                if (!empty($video) && !empty($user)) {
                    //Query video and maybe user
                    $videodata = new EstadoVideo();  
                    $videodata->setCompleto(false);
                    $videodata->setVideo($video);
                    $videodata->setUsuario($user);
                }
                
            }
            
            $videodata->setPorcentaje($percent);
            $videodata->setTiempo($currentTime);
            $videodata->setTiempototal($totalTime);
            
            //Consider incomplete
            if ($videodata->getPorcentaje() < 2) {
                $videodata->setTiempo(0);
            }
            
            //Consider complete and watched once
            if ($videodata->getPorcentaje() >= 98) {
                $videodata->setPorcentaje(100);
                $videodata->setCompleto(true);
                $videodata->setTiempo(0);
            }
            
            $videodata->setModificado(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($videodata);
            $entityManager->flush();
            
            $status = true;
        } else {
            $status = false;
        }
        
        $response = new JsonResponse(['status' => $status]);
        return $response;
    }
    
    /**
     * Sets video stats per user
     * @Route("/ajax/video/setfavouritestatus", name="capsule_ajax_savefav")
     */
    public function favouritesave(Request $req) {
        //Video id
        $vid = $req->query->get('vid');
        $isfav = $req->query->get('isfav');
        
        if ($req->isXmlHttpRequest() && $vid) {
            $uid = $this->getUser()->getId();
            $user = $this->uRepo->find($uid);
            $video = $this->vRepo->find($vid);
            
            if ($isfav && !is_null($video)) {
                $dbfav = $video->addFan($user);
                $status = true;
            } else if ( !$isfav && !is_null( $video ) ){
                $dbfav = $video->removeFan($user);
                $status = true;
            } else {
                $status = false;
                $dbfav = false;
            }
        } else {
            $status = false;
        }
        
        if ($status) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($video);
            $entityManager->persist($user);
            $entityManager->flush();
        }
        
        $response = new JsonResponse(['status' => $status, 'dbfav' => $dbfav]);
        return $response;
    }
    
    
}