<?php
namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Director;
use App\Entity\Productor;
use App\Entity\Grupo;
use App\Entity\Temporada;
use App\Entity\Video;
use App\Entity\EstadoVideo;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

class BrowseController extends AbstractController {
    
    private $catRepo;
    private $dirRepo;
    private $proRepo;
    private $vidRepo;
    private $groupRepo;
    private $tempRepo;
    private $evidRepo;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->catRepo = $entityManager->getRepository(Categoria::class);
        $this->dirRepo = $entityManager->getRepository(Director::class);
        $this->proRepo = $entityManager->getRepository(Productor::class);
        $this->groupRepo = $entityManager->getRepository(Grupo::class);
        $this->tempRepo = $entityManager->getRepository(Temporada::class);
        $this->vidRepo = $entityManager->getRepository(Video::class);
        $this->evidRepo = $entityManager->getRepository(EstadoVideo::class);
    }
    
    /**
     * Browse base dir
     * @Route("/browse", name="capsule_browse")
     */
    public function browseIndex(Request $req) {
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $search_term= $req->request->get('s');
        
        //Lists for select2
        $allcats = $this->catRepo->findAllOrderName();
        $alldirs = $this->dirRepo->findAllOrderName();
        $allprods = $this->proRepo->findAllOrderName();
        
        return $this->render('browse/browse.html.twig', [
                'catlist' => $allcats,
                'dirlist' => $alldirs,
                'prodlist' => $allprods,
                'search_term' => $search_term
            ]);

    }
    
    /**
     * Show list of show seasons
     * @Route("/show/{id}", name="capsule_browse_show")
     */
    public function listShow($id) {
        $trigger404 = false;
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        //Input correct
        if (is_numeric($id)) {
            $thisitem = $this->groupRepo->findOneShowById($id);
            if ( null === $thisitem ) {
                $trigger404 = true;
            }
            
            $thisseason = $this->tempRepo->findByShowOrder($id);
            $lastwatched = $this->evidRepo->findByLatestUpdatedTimeAndShow($this->getUser()->getId(),$id);
            if ( ! $lastwatched && $thisitem ) {
                $lastwatched = $thisitem->getVideos()[0];
            }

        } else {
            $trigger404 = true;
        }
        
        //Produce result depending on data
        if ($thisitem && $thisseason && $lastwatched && !$trigger404) {
            return $this->render('browse/groupitem.html.twig', [
                'activeitem' => $thisitem,
                'seasonitem' => $thisseason,
                'lastwatched' => $lastwatched,
                'type' => 'show',
                'isAjaxPaginator' => true,
            ]);
        } else {
             throw $this->createNotFoundException('Resource not found');
        }
        
    }
    
    /**
     * Saga page
     * @Route("/saga/{id}/{page}", name="capsule_browse_saga",requirements={"page"="\d+"})
     */
    public function listSaga($id,$page = 1, Request $req) {
        $trigger404 = false;
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $currentPage = $page;
        $limitPerPage = 4;
        
        //Input correct
        if (is_numeric($id)) {
            $thisvideos = $this->vidRepo->findAllMoviesOfTypePaged($id,$currentPage,$limitPerPage,0);
            $thisitem = $this->groupRepo->findOneSagaById($id);
        } else {
            $trigger404 = true;
        }
        
        //Produce result depending on data
        if ($thisvideos && $thisitem && !$trigger404) {
            return $this->render('browse/groupitem.html.twig', [
                    'activeitemvideos' => $thisvideos, //Los videos
                    //'activeiteminfo' => $thisitem, //Datos del grupo
                    'activeitem' => $thisitem, //Datos del grupo
                    'type' => 'saga', //Tipo pagina
                    
                    //Cosas del paginado here
                    'maxPages' => ceil($thisvideos->count() / $limitPerPage),
                    'currentPage' => $currentPage,
                    'currentPath' => $req->attributes->get('_route'),
                    'isAjaxPaginator' => false
                ]);
        } else {
            throw $this->createNotFoundException('Resource not found');
        }

    }
    
    /**
     * Director video page
     * @Route("/director/{id}/{page}", name="capsule_browse_director",requirements={"page"="\d+"})
     */
    public function viewDirector($id, $page = 1, Request $req) {
        $trigger404 = false;
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $currentPage = $page;
        $limitPerPage = 4;

        //Input correct
        if (is_numeric($id)) {
            $thisvideos = $this->vidRepo->findAllVideosOfDirectorPaged($id,$currentPage,$limitPerPage);
            $thisitem = $this->dirRepo->find($id);
        } else {
            $trigger404 = true;
        }
        
        //Produce result depending on data
        if ($thisvideos && $thisitem && !$trigger404) {
            
            return $this->render('browse/groupitem.html.twig', [
                    'activeitemvideos' => $thisvideos,
                    'activeitem' => $thisitem,
                    'type' => 'director',
                    
                    //Cosas del paginado here
                    'maxPages' => ceil($thisvideos->count() / $limitPerPage),
                    'currentPage' => $currentPage,
                    'currentPath' => $req->attributes->get('_route'),
                    'isAjaxPaginator' => false
                ]);
        } else {
            throw $this->createNotFoundException('Resource not found');
        }
    }
    
    /**
     * Matches the site base dir
     * @Route("/producer/{id}/{page}", name="capsule_browse_producer",requirements={"page"="\d+"})
     */
    public function viewProducer($id, $page = 1, Request $req) {
        $trigger404 = false;
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $currentPage = $page;
        $limitPerPage = 4;
        
        //Input correct
        if (is_numeric($id)) {
            $thisvideos = $this->vidRepo->findAllVideosOfProducerPaged($id,$currentPage,$limitPerPage);
            $thisitem = $this->proRepo->find($id);
        } else {
            $trigger404 = true;
        }
        
        //Produce result depending on data
        if ($thisvideos && $thisitem && !$trigger404) {
        
        return $this->render('browse/groupitem.html.twig', [
                'activeitemvideos' => $thisvideos,
                'activeitem' => $thisitem,
                'type' => 'producer',
                
                //Cosas del paginado here
                'maxPages' => ceil($thisvideos->count() / $limitPerPage),
                'currentPage' => $currentPage,
                'currentPath' => $req->attributes->get('_route'),
                'isAjaxPaginator' => false
            ]);
        } else {
            throw $this->createNotFoundException('Resource not found');
        }

    }
    
    /**
     * Matches the site base dir
     * @Route("/category/{id}/{page}", name="capsule_browse_category",requirements={"page"="\d+"})
     */
    public function viewCategory($id, $page = 1, Request $req) {
        $trigger404 = false;
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $currentPage = $page;
        $limitPerPage = 4;
        
        //Input correct
        if (is_numeric($id)) {
            $thisvideos = $this->vidRepo->findAllVideosOfCategoryPaged($id,$currentPage,$limitPerPage);
            $thisitem = $this->catRepo->find($id);
        } else {
            $trigger404 = true;
        }
        
        //Produce result depending on data
        if ($thisvideos && $thisitem && !$trigger404) {
            return $this->render('browse/groupitem.html.twig', [
                    'activeitemvideos' => $thisvideos,
                    'activeitem' => $thisitem,
                    'type' => 'category',
                    
                    //Cosas del paginado here
                    'maxPages' => ceil($thisvideos->count() / $limitPerPage),
                    'currentPage' => $currentPage,
                    'currentPath' => $req->attributes->get('_route'),
                    'isAjaxPaginator' => false
                ]);
        } else {
            throw $this->createNotFoundException('Resource not found');
        }

    }
    
}