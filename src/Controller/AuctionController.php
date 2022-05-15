<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionController extends AbstractController
{
    #[Route('/auction', name: 'app_auction')]
    public function index(): Response
    {
        return $this->render('auction/index.html.twig', [
            'controller_name' => 'AuctionController',
        ]);
    }
}
