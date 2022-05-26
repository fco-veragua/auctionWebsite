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
    #[Route('/user/auction', name: 'app_user_auction')]
    public function index(): Response
    {
        return $this->render('user_auction/index.html.twig', [
            'controller_name' => 'UserAuctionController',
        ]);
    }
}
