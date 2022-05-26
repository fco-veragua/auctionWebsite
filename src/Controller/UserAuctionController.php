<?php

namespace App\Controller;

use App\Entity\Auction;
use App\Entity\UserAuction;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\AuctionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

use function PHPUnit\Framework\throwException;

class UserAuctionController extends AbstractController
{
    private $auctionRepository;

    public function __construct(AuctionRepository $auctionRepository, EntityManagerInterface $toPersist)
    {
        $this->auctionRepository = $auctionRepository;
        $this->toPersist = $toPersist;
    }
    // #[Route('/user/auction', name: 'app_user_auction')]
    // public function index(): Response
    // {
    //     return $this->render('user_auction/index.html.twig', [
    //         'controller_name' => 'UserAuctionController',
    //     ]);
    // }

    #[Route('/bidup', name: 'app_bidup')]
    /**
     * (options={"expose"=true})
     */
    public function bidup(Request $request, ManagerRegistry $doctrine)
    {
        if ($request->isXmlHttpRequest()) {
            $userAuction = new UserAuction(); // new bid

            // DEFAULT VALUES
            $userAuction->setBidDate(new \DateTime('@' . strtotime('now'))); // Default date (the user bids at that moment)

            // I get the affected auction
            $id = $request->request->get(key: 'id');
            $auction = $doctrine->getRepository(Auction::class)->find($id);
            $userAuction->setAuction($auction);

            $user = $this->getUser(); // current User
            $userAuction->setUser($user);

            $bids = $auction->getUserAuctions();
            $auction->addUserAuction($bids);

            $this->toPersist->flush();

            return new JsonResponse(['bids' => $bids]);
            
        } else {
            throw new \Exception('Are you trying to hack me?');
        }
    }
}
