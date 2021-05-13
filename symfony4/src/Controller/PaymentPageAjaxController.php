<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PaymentPageAjaxController extends AbstractController {

    public function __construct() {

    }
    
    /**
     * Gets the current base price for javascripts.
     * @Route("/ajax/payment/getcurrentbaseprice", name="capsule_ajax_baseprice")
     */
    public function baseprice() {
        return new JsonResponse(['price' => getenv('CAPSULE_BASE_PRICE')]);
    }
    
}