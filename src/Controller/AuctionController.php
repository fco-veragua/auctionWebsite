<?php

namespace App\Controller;

use App\Repository\AuctionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionController extends AbstractController
{
    private $auctionRepository;

    public function __construct(AuctionRepository $auctionRepository)
    {
        $this->auctionRepository = $auctionRepository;
    }

    // Get information

    #[Route('/auction', methods: ['GET'], name: 'index')]
    public function index(): Response
    {
        $auctions = $this->auctionRepository->findAll();
        // dd($auctions); // Filter the inner elements of doctrine

        return $this->render('auction/index.html.twig', [
            'auctions' => $auctions
        ]);

        // !!! missing add error if no auctions found (404...)
    }

    #[Route('/auction/{id}', methods: ['GET'], name: 'show')]
    public function show($id): Response
    {
        $auction = $this->auctionRepository->find($id);
        // dd($auctions); // Filter the inner elements of doctrine

        return $this->render('auction/show.html.twig', [
            'auction' => $auction
        ]);

        // !!! missing add error if no auctions found (404...)
    }

    // Create new data
    
    // Render the template from which to create a new auction
    #[Route('/sell', name: 'sell')]
    public function sell(): Response
    {
        return $this->render('auction/sell.html.twig');

        // !!! missing add error if no auctions found (404...)
    }
}
