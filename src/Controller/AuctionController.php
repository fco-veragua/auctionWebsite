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

    #[Route('/auction', methods: ['GET'], name: 'app_auction')]
    public function index(): Response
    {
        $auctions = $this->auctionRepository->findAll();
        // dd($auctions); // Filter the inner elements of doctrine

        return $this->render('auction/index.html.twig', [
            'auctions' => $auctions
        ]);

        // missing add error if no auctions found (404...)
    }

    #[Route('/auction/{id}', methods: ['GET'], name: 'app_auction')]
    public function show($id): Response
    {
        $auction = $this->auctionRepository->find($id);
        // dd($auctions); // Filter the inner elements of doctrine

        return $this->render('auction/show.html.twig', [
            'auctions' => $auctions
        ]);

        // missing add error if no auctions found (404...)
    }
}
