<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Video;
use App\Service\OMDBService;

use \DateTime;

/**
 * Video controller
 */
class VideoController extends AbstractController {
    
    private $videoRepo;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->videoRepo = $entityManager->getRepository(Video::class);
    }
    
    /**
     * Matches the site base dir
     * @Route("/video/{vid}", name="capsule_vid")
     */
    public function indexVideo($vid, OMDBService $omdbsvc) {
        $trigger404 = false;
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY'); //Usuario debe estar logged in
        
        if ( ! is_numeric( $vid ) )  {
            $trigger404 = true;
        }
        
        //Id is correct
        if (!$trigger404) {
            $account = $this->getUser();
            //Read video data
            $videodata = $this->videoRepo->find($vid);
            
            //Video exists
            if ( null !== $videodata ) {
                $isfav = $this->videoRepo->findUserFan($account->getId(),$vid);
                $now = new DateTime();
                
                //User has access
                $agestatus = true;
                $userage = $now->diff($account->getFechanac());
                $userage = $userage->y;
                $videoage = $videodata->getEdad();
                if ($userage < $videoage) {
                    $agestatus = false;
                }
                
                $premiumstatus = true;
                if ($videodata->getPremium()) {
                    //User has enough premium time left
                    $userpremium = $account->getFechapremium();
                    if ($userpremium < $now) {
                        $premiumstatus = false;
                    }
                }
                
                //Check if video launched
                $released = true;
                if ($videodata->getFechaonline() > $now) {
                    $released = false;
                }
                
                //Get the previus and next video only if it is a show
                $nextvideo = null;
                $prevideo = null;
                if ( $videodata->getTemporada() ) {
                    $nextvideo = $this->videoRepo->findNextVideo(
                        $videodata->getId(), 
                        $videodata->getFecharodada(), 
                        $videodata->getTemporada()->getId()
                    );
                    $prevideo = $this->videoRepo->findPreVideo(
                        $videodata->getId(),
                        $videodata->getFecharodada(),
                        $videodata->getTemporada()->getId()
                    );    
                }
                
                //Get OMDB Info
                if ($term = $videodata->getTerminoomdb()) {
                    $omdbapi = $omdbsvc->request($term);
                } else {
                    $omdbapi = null;
                }
            } else {
                $trigger404 = true;
            }
        }
        
        if (!$trigger404) {
            return $this->render('videoplayer/test.html.twig', [
                'videodata' => $videodata,
                'prevideo' => $prevideo,
                'nextvideo' => $nextvideo,
                'useraccount' => $account,
                'isfav' => $isfav,
                'premiumstatus' => $premiumstatus,
                'agestatus' => $agestatus,
                'releasestatus' => $released,
                'omdbapi' => $omdbapi
            ]);
        } else {
            throw $this->createNotFoundException('Resource not found');
        }
            
    }
}