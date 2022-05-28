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
use App\Repository\AuctionRepository;

use function PHPUnit\Framework\throwException;

class UserAuctionController extends AbstractController // Controller for bids
{
    private $userAuctionRepository;
    private $auctionRepository;

    public function __construct(AuctionRepository $auctionRepository, UserAuctionRepository $userAuctionRepository, EntityManagerInterface $toPersist)
    {
        $this->auctionRepository = $auctionRepository;
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

    #[Route('/bids/{id}', methods: ['GET'], name: 'bids')]
    public function index($id): Response
    {
        $userAuctions = $this->userAuctionRepository->findAll($id);



        // dd($auctions); // Filter the inner elements of doctrine

        return $this->render('bid/bids.html.twig', [
            'userAuctions' => $userAuctions,

        ]);

        // !!! missing add error if no auctions found (404...)
    }

    #[Route('/bids/create/{id}', name: 'bidup')] // Added auction id
    public function bidup($id, Request $request, ManagerRegistry $doctrine): Response
    {
        $userAuction = new UserAuction();
        $auction = $this->auctionRepository->find($id); // current auction
        $userAuctions = $auction->getUserAuctions(); // current bids

        // DEFAULT VALUES
        $userAuction->setBidDate(new \DateTime('@' . strtotime('now'))); // Default date

        $auction = $this->auctionRepository->find($id);
        $userAuction->setAuction($auction);

        $user = $this->getUser(); // current User
        $userAuction->setUser($user);

        $form = $this->createForm(BidFormType::class, $userAuction);

        $form->handleRequest($request);

        $formContain = $form->get('bidValue')->getData();

        if ($form->isSubmitted() && $form->isValid()) {

            // if (null === $userAuctions) { // if there are no bids
            //     if ($form->get('bidValue') >= $formContain) {
            //         $newUserAuction = $form->getData();
            //         // dd($newAuction);
            //         // exit;

            //         $this->toPersist->persist($newUserAuction);
            //         $this->toPersist->flush();

            //         $this->addFlash('notice', 'You have placed the bid!');
            //     } else {
            //         $this->addFlash('bid_1', 'The value of the bid, must be greater than or equal to the starting price');
            //     }
            // } else {
            //     if ($form->get('bidValue') > $maxBid) {
            //         $newUserAuction = $form->getData();
            //         // dd($newAuction);
            //         // exit;

            //         $this->toPersist->persist($newUserAuction);
            //         $this->toPersist->flush();

            //         $this->addFlash('notice', 'You have placed the bid!');
            //     } else {
            //         $this->addFlash('bid_2', 'The value of the bid, must be greater than last Bid');
            //     }
            // }

            $newUserAuction = $form->getData();
            // dd($newAuction);
            // exit;

            $this->toPersist->persist($newUserAuction);
            $this->toPersist->flush();

            $this->addFlash(
                'notice',
                'You have placed the bid!'

            );

            //return $this->redirectToRoute('/auction/{id}');
        }

        return $this->render('bid/bids.html.twig', [
            'form' => $form->createView(),
            'userAuctions' => $userAuctions,
            'auction' => $auction
        ]);
        // !!! missing add error if no auctions found (404...)
    }
}
