<?php

namespace App\Controller;

use App\Entity\Auction;
use App\Entity\Category;
use App\Entity\User;
use App\Form\AuctionFormType;
use App\Form\AuctionJewelFormType;
use App\Form\AuctionBookFormType;
use App\Form\AuctionMusicFormType;
use App\Repository\AuctionRepository;
use App\Repository\UserAuctionRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use PHPStan\PhpDocParser\Ast\Type\ThisTypeNode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Intl\Scripts;
use Symfony\Component\Mime\Address;

class AuctionController extends AbstractController
{
    private $toPersist;
    private $auctionRepository;
    private $userAuctionRepository;

    public function __construct(UserAuctionRepository $userAuctionRepository, AuctionRepository $auctionRepository, EntityManagerInterface $toPersist)
    {
        $this->userAuctionRepository = $userAuctionRepository;
        $this->auctionRepository = $auctionRepository;
        $this->toPersist = $toPersist;
    }

    // Get information

    #[Route('/', methods: ['GET'], name: 'index')]
    public function index(): Response
    {
        $auctions = $this->auctionRepository->findAll();


        // dd($auctions); // Filter the inner elements of doctrine

        return $this->render('auction/index.html.twig', [
            'auctions' => $auctions
        ]);

        // !!! missing add error if no auctions found (404...)
    }

    #[Route('/all', methods: ['GET'], name: 'all')]
    public function all(): Response
    {
        $auctions = $this->auctionRepository->findAll();


        // dd($auctions); // Filter the inner elements of doctrine

        return $this->render('auction/all.html.twig', [
            'auctions' => $auctions
        ]);

        // !!! missing add error if no auctions found (404...)
    }

    #[Route('/cron', methods: ['GET'], name: 'cron')]
    public function cron(): Response
    {
        $auctions = $this->auctionRepository->findClosing();
        foreach ($auctions as $auction) {
            $user = $auction->getUser();
        //     $this->emailVerifier->sendEmailConfirmation(
        //     $user,
        //     (new TemplatedEmail())
        //         ->from(new Address('asir1.fvc@gmail.com', 'Auction Website Bot'))
        //         ->to($user->getEmail())
        //         ->subject('Please Confirm your Email')
        //         ->htmlTemplate('auction/closingconfirmation_email.html.twig')
        // );

            // $userAuctions = $auction->getUserAuctions();
            // $this->toPersist->remove($userAuctions);
            $this->toPersist->remove($auction);
        }

        $this->toPersist->flush();

        // dd($auctions); // Filter the inner elements of doctrine

        return new Response('Ok');

        // !!! missing add error if no auctions found (404...)
    }

    // CREATE auction
    #[Route('/auction/create', name: 'create')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $auction = new Auction();

        // DEFAULT VALUES
        $auction->setStartDate(new \DateTime('@' . strtotime('now'))); // Default date

        $auction->setUpdateAt(new \DateTime('@' . strtotime('now')));

        // $auction->setPhotosName('AuctionTest');

        $category = $doctrine->getRepository(Category::class)->find(1); // Art Category
        $auction->setCategory($category);

        $user = $this->getUser(); // current User
        $auction->setUser($user);

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

    // CREATE Jewel auction
    #[Route('/auction/createjewel', name: 'createjewel')]
    public function createjewel(Request $request, ManagerRegistry $doctrine): Response
    {
        $auction = new Auction();

        // DEFAULT VALUES
        $auction->setStartDate(new \DateTime('@' . strtotime('now'))); // Default date

        $auction->setUpdateAt(new \DateTime('@' . strtotime('now')));

        // $auction->setPhotosName('AuctionTest');

        $category = $doctrine->getRepository(Category::class)->find(2); // Jewels Category
        $auction->setCategory($category);

        $user = $this->getUser(); // current User
        $auction->setUser($user);

        $form = $this->createForm(AuctionJewelFormType::class, $auction);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newAuction = $form->getData();
            // dd($newAuction);
            // exit;

            $this->toPersist->persist($newAuction);
            $this->toPersist->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('auction/createjewel.html.twig', [
            'form' => $form->createView()
        ]);
        // !!! missing add error if no auctions found (404...)
    }

    // CREATE Book auction
    #[Route('/auction/createbook', name: 'createbook')]
    public function createbook(Request $request, ManagerRegistry $doctrine): Response
    {
        $auction = new Auction();

        // DEFAULT VALUES
        $auction->setStartDate(new \DateTime('@' . strtotime('now'))); // Default date

        $auction->setUpdateAt(new \DateTime('@' . strtotime('now')));

        // $auction->setPhotosName('AuctionTest');

        $category = $doctrine->getRepository(Category::class)->find(3); // Books Category
        $auction->setCategory($category);

        $user = $this->getUser(); // current User
        $auction->setUser($user);

        $form = $this->createForm(AuctionBookFormType::class, $auction);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newAuction = $form->getData();
            // dd($newAuction);
            // exit;

            $this->toPersist->persist($newAuction);
            $this->toPersist->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('auction/createbook.html.twig', [
            'form' => $form->createView()
        ]);
        // !!! missing add error if no auctions found (404...)
    }

    // CREATE Music auction
    #[Route('/auction/createmusic', name: 'createmusic')]
    public function createmusic(Request $request, ManagerRegistry $doctrine): Response
    {
        $auction = new Auction();

        // DEFAULT VALUES
        $auction->setStartDate(new \DateTime('@' . strtotime('now'))); // Default date

        $auction->setUpdateAt(new \DateTime('@' . strtotime('now')));

        // $auction->setPhotosName('AuctionTest');

        $category = $doctrine->getRepository(Category::class)->find(4); // Music Category
        $auction->setCategory($category);

        $user = $this->getUser(); // current User
        $auction->setUser($user);

        $form = $this->createForm(AuctionMusicFormType::class, $auction);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newAuction = $form->getData();
            // dd($newAuction);
            // exit;

            $this->toPersist->persist($newAuction);
            $this->toPersist->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('auction/createmusic.html.twig', [
            'form' => $form->createView()
        ]);
        // !!! missing add error if no auctions found (404...)
    }

    // UPDATE auction
    #[Route('/auction/edit/{id}', name: 'edit')]
    public function edit($id, Request $request): Response
    {
        $auction = $this->auctionRepository->find($id);
        $form = $this->createForm(AuctionFormType::class, $auction);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $auction->setTitle($form->get('title')->getData());
            $auction->setDescription($form->get('description')->getData());
            $auction->setState($form->get('state')->getData());
            $auction->setPrice($form->get('price')->getData());
            $auction->setClosingDate($form->get('closingDate')->getData());

            $this->toPersist->flush();
            return $this->redirectToRoute('index');
        }

        return $this->render('auction/edit.html.twig', [
            'auction' => $auction,
            'form' => $form->createView()
        ]);
        // dd($id);
        // exit;
        // !!! missing add error if no auctions found (404...)
    }

    // UPDATE Jewel auction
    #[Route('/auction/editjewel/{id}', name: 'editjewel')]
    public function editjewel($id, Request $request): Response
    {
        $auction = $this->auctionRepository->find($id);
        $form = $this->createForm(AuctionJewelFormType::class, $auction);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $auction->setTitle($form->get('title')->getData());
            $auction->setDescription($form->get('description')->getData());
            $auction->setState($form->get('state')->getData());
            $auction->setPrice($form->get('price')->getData());
            $auction->setClosingDate($form->get('closingDate')->getData());

            $this->toPersist->flush();
            return $this->redirectToRoute('index');
        }

        return $this->render('auction/editjewel.html.twig', [
            'auction' => $auction,
            'form' => $form->createView()
        ]);
        // dd($id);
        // exit;
        // !!! missing add error if no auctions found (404...)
    }

    // UPDATE Book auction
    #[Route('/auction/editbook/{id}', name: 'editbook')]
    public function editbook($id, Request $request): Response
    {
        $auction = $this->auctionRepository->find($id);
        $form = $this->createForm(AuctionBookFormType::class, $auction);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $auction->setTitle($form->get('title')->getData());
            $auction->setDescription($form->get('description')->getData());
            $auction->setState($form->get('state')->getData());
            $auction->setPrice($form->get('price')->getData());
            $auction->setClosingDate($form->get('closingDate')->getData());

            $this->toPersist->flush();
            return $this->redirectToRoute('index');
        }

        return $this->render('auction/editbook.html.twig', [
            'auction' => $auction,
            'form' => $form->createView()
        ]);
        // dd($id);
        // exit;
        // !!! missing add error if no auctions found (404...)
    }

    // UPDATE Music auction
    #[Route('/auction/editmusic/{id}', name: 'editmusic')]
    public function editmusic($id, Request $request): Response
    {
        $auction = $this->auctionRepository->find($id);
        $form = $this->createForm(AuctionMusicFormType::class, $auction);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $auction->setTitle($form->get('title')->getData());
            $auction->setDescription($form->get('description')->getData());
            $auction->setState($form->get('state')->getData());
            $auction->setPrice($form->get('price')->getData());
            $auction->setClosingDate($form->get('closingDate')->getData());

            $this->toPersist->flush();
            return $this->redirectToRoute('index');
        }

        return $this->render('auction/editmusic.html.twig', [
            'auction' => $auction,
            'form' => $form->createView()
        ]);
        // dd($id);
        // exit;
        // !!! missing add error if no auctions found (404...)
    }

    // DELETE auction
    #[Route('/auction/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete')]
    public function delete($id): Response
    {
        $auction = $this->auctionRepository->find($id);

        // EXTRA 
        //$userAuctions = $auction->getUserAuctions();
        //$this->toPersist->remove($userAuctions);


        $this->toPersist->remove($auction);
        $this->toPersist->flush();

        return $this->redirectToRoute('index');
    }

    // Delete AUCTION after closing and notify users
    public function delclosing($id): Response
    {
        $auction = $this->auctionRepository->find($id);
        $user = $auction->getUser();
        $userAuctions = $auction->getUserAuctions();

        // Here I must include the logic to send a message to the buyer and create a badge for the seller

        // $this->emailVerifier->sendEmailConfirmation(
        //     $user,
        //     (new TemplatedEmail())
        //         ->from(new Address('asir1.fvc@gmail.com', 'Auction Website Bot'))
        //         ->to($user->getEmail())
        //         ->subject('Please Confirm your Email')
        //         ->htmlTemplate('auction/closingconfirmation_email.html.twig')
        // );

        $this->toPersist->remove($userAuctions);
        $this->toPersist->remove($auction);
        $this->toPersist->flush();

        return $this->redirectToRoute('index');
    }

    #[Route('/auction/{id}', methods: ['GET'], name: 'show')]
    public function show($id): Response
    {
        $auction = $this->auctionRepository->find($id);
        $userAuctions = $auction->getUserAuctions();

        // dd($auctions); // Filter the inner elements of doctrine

        return $this->render('auction/show.html.twig', [
            'auction' => $auction,
            'userAuctions' => $userAuctions
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
