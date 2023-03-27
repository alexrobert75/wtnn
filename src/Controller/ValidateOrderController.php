<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ValidateOrderController extends AbstractController
{
    #[Route('/validate/order', name: 'app_checkout')]
    public function index(): Response
    {
        return $this->render('validate_order/index.html.twig', [
            'controller_name' => 'ValidateOrderController',
        ]);
    }
}
