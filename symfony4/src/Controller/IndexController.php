<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Doctrine\ORM\EntityManagerInterface;
use App\Queries\OverviewQueries;

use App\Entity\EstadoVideo;
use App\Entity\Video;
use App\Entity\Grupo;
use App\Entity\Categoria;

class IndexController extends AbstractController {
    
    private $evRepo;
    private $vRepo;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->evRepo = $entityManager->getRepository(EstadoVideo::class);
        $this->vRepo = $entityManager->getRepository(Video::class);
        $this->gRepo = $entityManager->getRepository(Grupo::class);
        $this->cRepo = $entityManager->getRepository(Categoria::class);
    }
    
    /**
     * Matches the site base dir
     * @Route("/", name="capsule_dashboard")
     */
    public function index() {
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY'); //Usuario debe estar logged in

        $itemlimit = 6; //Max inclusive
        
        /** 
         * Videos que el usuario está viendo actualmente
         * Ordenado por porcentaje
         * Que no estén completos
         */
        $watching = $this->evRepo->findByUserCompletion($this->getUser()->getId(), $itemlimit);
        
        /**
         * Videos ordenados por el numero de fans
         */
        $loved = $this->vRepo->listVideosByFans(3);
        
        /**
         * Recomendados:
         * Ve los videos que tenga como completo, saca sus categorias.
         * La segunda consulta coge todos los videos de esas categorias
         * Se excluyen los que ya se ha visto.
         */
        $complete = $this->vRepo->findByUserComplete($this->getUser()->getId());
        $allids = [];
        foreach ($complete as $c) {
            $catids = [];
            $cat = $c->getCategorias();
            foreach ($cat as $c2) {
                $catids[] = $c2->getId();
            }
            $allids[] = $catids;
        }
        
        $allids = $this->flatten_array($allids);
        $allids = array_unique($allids);
        
        $recommend = [];
        if (!empty($allids)) {
            $recommend = $this->vRepo->findByCategoryArrayNotComplete($this->getUser()->getId(),$allids, $itemlimit);
        }
        
        /**
         * Videos que compartan la/las categorias de un video aleatorio que se haya completado.
         * Es necesario sacar el vídeo del que se sacan las categorías
         * "Porque has visto Tokyo Ghoul"
         * -- slider de videos que tengan categorias comunes con Tokyo Ghoul
         * 
         * "Porque has visto Juego de Tronos"
         * -- slider de videos que tengan categorias comunes con GOT
         * 
         * Se excluyen los vistos y la misma serie.
         */
         
        $singlerecommend = [];
        if ( ! empty($complete) ) {
            $rand = mt_rand(0, (count($complete) - 1));
            $therandom = $complete[$rand];
            $catids = [];
            $cat = $therandom->getCategorias();
            foreach ($cat as $c) {
                $catids[] = $c->getId();
            }
            $groupid = null;
            if ($therandom->getGrupo()) {
                $groupid = $therandom->getGrupo()->getId();
            }
            if (!empty($catids)) {
                $singlerecommend['vid'] = $this->vRepo->findByCategoryArrayNotComplete($this->getUser()->getId(),$catids, $itemlimit,$groupid);
            }
            $singlerecommend['title'] = $therandom;
            
        }
        
        /* Videos exclusivos al premium LANZADOS
            No completados
            Aleatorios con un maximo
        */
        $premium = $this->vRepo->findByPremiumOnlyRand($this->getUser()->getId(), $itemlimit);
        
        /**
         * Saca capitulos o peliculas recién lanzados
         * Se excluyen ya vistos
         */
        $latest = $this->vRepo->findByDateLatestOrder($this->getUser()->getId(),$itemlimit);
        
        /**
         * Saca capitulos o peliculas que se lanzarán pronto
         * Primero muestra los mas inmediatos
         */
        $upcoming = $this->vRepo->findByDateUpcomingOrder($itemlimit);
        
        /**
         * Saca todas las categorias y videos aleatorios de ellas
         */
        $allcats = $this->cRepo->findAllOrderName();
        $newallcats = [];
        foreach ($allcats as $cat) {
            $vids = $cat->getVideos();
            $videonum = count($vids);
            if ($itemlimit >= $videonum) {
                //If our max display limit is larger than count, display all
                $videolist = $vids;
            } else {
                //More videos than display: Random videos, no repeat
                $videolist = [];
                
                // List range of all video numbers
                $ids = range(0,($videonum - 1));
                // Shuffle these numbers
                shuffle($ids);
                // Remove items until the limit
                for ($i = 0; $i<$itemlimit; $i++) {
                    // Get a video id
                    $id = array_shift($ids);
                    $videolist[] = $vids[$id];
                }

            }
            
            $newcat = [];
            $newcat['id'] = $cat->getId();
            $newcat['titulo'] = $cat->getTitulo();
            $newcat['descripcion'] = $cat->getDescripcion();
            $newcat['videos'] = $videolist;
            $newallcats[] = $newcat;
        }
        
        return $this->render('dashboard.html.twig', [
                'watching' => $watching, //Query OK
                'premvids' => $premium, //Query OK
                'loved' => $loved, //Query OK
                'recommend' => $recommend, //Query OK
                'latest' => $latest, //Query OK
                'upcoming' => $upcoming, //Query OK
                'singlerecommend' => $singlerecommend, //Query OK
                'allcats' => $newallcats //Query OK
            ]);
    }
    
    function flatten_array(array $array) {
        return iterator_to_array(
             new \RecursiveIteratorIterator(new \RecursiveArrayIterator($array)));
    }
    
}