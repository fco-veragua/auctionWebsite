<?php

namespace App\Controller;

use App\Entity\Auction;
use App\Entity\UserAuction;
use App\Form\BidFormType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\UserAuctionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

use function PHPUnit\Framework\throwException;

class UserAuctionController extends AbstractController
{
    private $userAuctionRepository;

    public function __construct(UserAuctionRepository $userAuctionRepository, EntityManagerInterface $toPersist)
    {
        $this->userAuctionRepository = $userAuctionRepository;
        $this->toPersist = $toPersist;
    }
    // #[Route('/user/auction', name: 'app_user_auction')]
    // public function index(): Response
    // {
    //     return $this->render('user_auction/index.html.twig', [
    //         'controller_name' => 'UserAuctionController',
    //     ]);
    // }

    #[Route('/auction/{id}', methods: ['GET'], name: 'bids')]
    public function index($id): Response
    {
        $userAuctions = $this->userAuctionRepository->findAll($id);
        // dd($auctions); // Filter the inner elements of doctrine

        return $this->render('bid/bids.html.twig', [
            'userAuctions' => $userAuctions
        ]);

        // !!! missing add error if no auctions found (404...)
    }

    #[Route('/auction/{id}', name: 'bidup')]
    public function bidup($id, Request $request, ManagerRegistry $doctrine): Response
    {
        $userAuction = new UserAuction();

        // DEFAULT VALUES
        $userAuction->setBidDate(new \DateTime('@' . strtotime('now'))); // Default date

        $auction = $this->auctionRepository->find($id);
        $userAuction->setAuction($auction);

        $user = $this->getUser(); // current User
        $userAuction->setUser($user);

        $form = $this->createForm(BidFormType::class, $userAuction);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newUserAuction = $form->getData();
            // dd($newAuction);
            // exit;

            $this->toPersist->persist($newUserAuction);
            $this->toPersist->flush();

            return $this->redirectToRoute('index');
        }

        // return $this->render('bid/bids.html.twig', [
        //     'form' => $form->createView()
        // ]);
        // !!! missing add error if no auctions found (404...)
    }
}
