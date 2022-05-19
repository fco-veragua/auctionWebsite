<?php

namespace App\Controller;

use App\Entity\Auction;
use App\Entity\Category;
use App\Entity\User;
use App\Form\AuctionFormType;
use App\Repository\AuctionRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AuctionController extends AbstractController
{
    private $toPersist;
    private $auctionRepository;

    public function __construct(AuctionRepository $auctionRepository, EntityManagerInterface $toPersist)
    {
        $this->auctionRepository = $auctionRepository;
        $this->toPersist = $toPersist;
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

    #[Route('/auction/create', name: 'create')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $auction = new Auction();

        // DEFAULT VALUES
        $auction->setStartDate(new \DateTime('@' . strtotime('now'))); // Default date

        $auction->setUpdateAt(new \DateTime('@' . strtotime('now')));

        $auction->setPhotosName('AuctionTest');

        $category = $doctrine->getRepository(Category::class)->find(1); // Art Category
        $auction->setCategory($category);

        $user = $doctrine->getRepository(User::class)->find(1);
        $auction->setUser($user); // DELETE AFTER USER LOGIN

        $form = $this->createForm(AuctionFormType::class, $auction);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newAuction = $form->getData();
            // dd($newAuction);
            // exit;

            $this->toPersist->persist($newAuction);
            $this->toPersist->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('auction/create.html.twig', [
            'form' => $form->createView()
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
