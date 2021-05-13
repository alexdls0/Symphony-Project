<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use App\Entity\Grupo;
use App\Entity\Video;
use App\Entity\Usuario;
use App\Entity\Temporada;

class BrowsePageAjaxController extends AbstractController {
    
    private $gRepo;
    private $vRepo;
    private $seaRepo;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->gRepo = $entityManager->getRepository(Grupo::class);
        $this->vRepo = $entityManager->getRepository(Video::class);
        $this->seaRepo = $entityManager->getRepository(Temporada::class);
    }
    
    /**
     * Gets the user requested video time
     * @Route("/ajax/browse/getsearchresults", name="capsule_ajax_browseresults")
     * @Method({"POST"})
     */
    public function searchresults(Request $req) {
        
        //Input params and properties
        $isRequest = $req->isXmlHttpRequest();
        $inputType = $req->request->get('type');
        $inputOrder = $req->request->get('order');
        $inputPremium = $req->request->get('premium');
        $inputComplete = $req->request->get('complete');
        $inputWatching = $req->request->get('watching');
        $inputAge = $req->request->get('age');
        $inputCategories = $req->request->get('categories');
        $inputDirectors = $req->request->get('directors');
        $inputProducers = $req->request->get('producers');
        $inputSearch = $req->request->get('searchterm');
        
        //Pagination
        $limitPerPage = 4;
        $currentPage = $req->request->get('page');
        if (empty($currentPage)) {
            $currentPage = 1;
        }
        
        //Querying respective tables
        if ($inputType == 'EP' && $isRequest) {
            $result = $this->vRepo->findBySearchMasterQuery($this->getUser()->getId(),
                                                        $inputOrder,
                                                        $inputPremium,
                                                        $inputComplete,
                                                        $inputWatching,
                                                        $inputAge,
                                                        $inputCategories,
                                                        $inputDirectors,
                                                        $inputProducers,
                                                        $inputSearch,
                                                        1, $currentPage, $limitPerPage);
        } else if ($inputType == 'SH' && $isRequest) {
            //MUST BE DONE IN A SINGLE QUERY FOR PAGINATION
            //Limits filtering options
            $result = $this->gRepo->findBySearchMasterQueryGroup($inputOrder,$inputSearch,1,$currentPage, $limitPerPage);
        } else if ($inputType == 'SG' && $isRequest) {
            //MUST BE DONE IN A SINGLE QUERY FOR PAGINATION
            //Limits filtering options
            $result = $this->gRepo->findBySearchMasterQueryGroup($inputOrder,$inputSearch,0,$currentPage, $limitPerPage);
        } else if ($inputType == 'MV' && $isRequest) {
            $result = $this->vRepo->findBySearchMasterQuery($this->getUser()->getId(),
                                                        $inputOrder,
                                                        $inputPremium,
                                                        $inputComplete,
                                                        $inputWatching,
                                                        $inputAge,
                                                        $inputCategories,
                                                        $inputDirectors,
                                                        $inputProducers,
                                                        $inputSearch,
                                                        0, $currentPage, $limitPerPage);
        } else if ($inputType == 'ALL' && $isRequest) {
            $result = $this->vRepo->findBySearchMasterQuery($this->getUser()->getId(),
                                                        $inputOrder,
                                                        $inputPremium,
                                                        $inputComplete,
                                                        $inputWatching,
                                                        $inputAge,
                                                        $inputCategories,
                                                        $inputDirectors,
                                                        $inputProducers,
                                                        $inputSearch,
                                                        null, $currentPage, $limitPerPage);
        } else {
            $result = false;
        }
        
        //Produce adequate result
        if ($result) {
            $render = $this->renderView('ajax/browse-tile.html.twig', ['contentlist' => $result]);
            $pdata['maxPages'] = ceil($result->count() / $limitPerPage);
            $pdata['currentPage'] = $currentPage;
            $pdata['currentPath'] = $req->attributes->get('_route');
            $pdata['isAjaxPaginator'] = true;
            $pagRender = $this->renderView('common/pagination.html.twig', $pdata);

        } else {
            $render = false;
            $pagRender = false;
        }
        
        return new JsonResponse(['data' => $render, 'paginator' => $pagRender]);
         
    }
    
    /**
     * Gets the user requested chapter of tv show
     * @Route("/ajax/show/getvideosofshow", name="capsule_ajax_getseasons")
     * @Method({"GET"})
     */
    public function searchseasons(Request $req) {
        //Input data
        $inputGrupo = $req->query->get('parent');
        $inputSeason = $req->query->get('current');
        
        //Pagination
        $limitPerPage = 4;
        $currentPage = $req->query->get('page');
        if (empty($currentPage)) {
            $currentPage = 1;
        }
        
        //Querying respective tables
        if ($inputGrupo && $inputSeason && $req->isXmlHttpRequest()) {
            $result['videos'] = $this->vRepo->findBySeasonShowPaged($inputSeason,
                                                            $inputGrupo,
                                                            $currentPage,
                                                            $limitPerPage);
        } else {
            $result = false;
        }
        
        //Produce result
        if ($result) {
            $render = $this->renderView('ajax/show-tile.html.twig', ['activeitem' => $result]);
            $pdata['maxPages'] = ceil($result['videos']->count() / $limitPerPage);
            $pdata['currentPage'] = $currentPage;
            $pdata['currentPath'] = $req->attributes->get('_route');
            $pdata['isAjaxPaginator'] = true;
            $pagRender = $this->renderView('common/pagination.html.twig', $pdata);

        } else {
            $render = false;
            $pagRender = false;
        }
        
        return new JsonResponse(['data' => $render, 'paginator' => $pagRender]);
         
    }
    
}