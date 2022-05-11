<?php

namespace App\DataFixtures;

use App\Entity\Auction;
use App\Entity\Badge;
use App\Entity\Category;
use App\Entity\User;
use App\Entity\UserAuction;
use App\Entity\UserBadge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EntityFixtures extends Fixture
{
    // public const CATEGORY_ID_REFERENCE = 'category';
    // public const CATEGORY_ID_REFERENCE2 = 'category2';
    // public const CATEGORY_ID_REFERENCE3 = 'category3';

    // public const USER_ID_REFERENCE = 'user';
    // public const USER_ID_REFERENCE2 = 'user2';
    // public const USER_ID_REFERENCE3 = 'user3';

    public function load(ObjectManager $manager): void
    {
        // -- User -- //
        // ================================= //
        $user = new User();
        $user->setEmail('gagosiangallery@gmail.com');
        $user->setPassword('gagosian1234');
        $user->setUserName('gagosianGallery');
        $user->setName('Larry');
        $user->setLastName('Gagosian');
        $user->setBirthDate(new \DateTime('1987-11-1'));
        $user->setCountry('New York');
        $user->setPostalCode(10011);
        $user->setStreetAddress('555 West 24th Street');
        $user->setCompanyName('Gagosian Gallery');
        $user->setPhoneNumber(111222333);

        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail('tiffanyandco@gmail.com');
        $user2->setPassword('tiffany1234');
        $user2->setUserName('tiffany&Co');
        $user2->setName('Jean');
        $user2->setLastName('Schlumberger');
        $user2->setBirthDate(new \DateTime('1970-11-1'));
        $user2->setCountry('Barcelona');
        $user2->setPostalCode(18007);
        $user2->setStreetAddress('Pg. de Grácia, 61');
        $user2->setCompanyName('Tiffany & Co');
        $user2->setPhoneNumber(444555666);

        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('thomasphillipps@gmail.com');
        $user3->setPassword('thomasphillipps1234');
        $user3->setUserName('thomasPhillipps');
        $user3->setName('Thomas');
        $user3->setLastName('Phillipps');
        $user3->setBirthDate(new \DateTime('1982-11-1'));
        $user3->setCountry('Portugal');
        $user3->setPostalCode(40501);
        $user3->setStreetAddress('R. das Carmelitas');
        $user3->setCompanyName('Livraria Lello');
        $user3->setPhoneNumber(777888999);

        $manager->persist($user3);

        $user4 = new User();
        $user4->setEmail('bidder1@gmail.com');
        $user4->setPassword('bidder1');
        $user4->setUserName('bidder1');
        $user4->setName('bidder1');
        $user4->setLastName('bidder1');
        $user4->setBirthDate(new \DateTime('1991-11-1'));
        $user4->setCountry('New York');
        $user4->setPostalCode(10011);
        $user4->setStreetAddress('bidder1');
        $user4->setCompanyName('bidder1');
        $user4->setPhoneNumber(122233344);

        $manager->persist($user4);
        // ================================= //

        // -- Category -- //
        // ================================= //
        $category = new Category();
        $category->setCategoryName('Art');

        $manager->persist($category);

        $category2 = new Category();
        $category2->setCategoryName('Jewels');

        $manager->persist($category2);

        $category3 = new Category();
        $category3->setCategoryName('Books');

        $manager->persist($category3);
        // ================================= //

        // -- Badge -- //
        // ================================= //
        $badge = new Badge();
        $badge->setDescription('Art is what you let out');
        $badge->setCategory($category);

        $manager->persist($badge);

        $badge2 = new Badge();
        $badge2->setDescription('Dont be afraid of perfection, you`ll never reach it');
        $badge2->setCategory($category);

        $manager->persist($badge2);

        $badge3 = new Badge();
        $badge3->setDescription('A woman needs strings and strings of pearls');
        $badge3->setCategory($category2);

        $manager->persist($badge3);

        $badge4 = new Badge();
        $badge4->setDescription('Life is a party, dress for her');
        $badge4->setCategory($category2);

        $manager->persist($badge4);

        $badge5 = new Badge();
        $badge5->setDescription('He who reads a lot and walks a lot, sees a lot and knows a lot');
        $badge5->setCategory($category3);

        $manager->persist($badge5);

        $badge6 = new Badge();
        $badge6->setDescription('Reading is to the mind what exercise is to the body');
        $badge6->setCategory($category3);

        $manager->persist($badge6);
        // ================================= //

        // -- Auction -- //
        // ================================= //
        $auction = new Auction();
        $auction->setCategory($category);
        $auction->setUser($user);
        $auction->setTitle('Painting False Menina');
        $auction->setDescription('Replica of the Las Meninas Painting');
        $auction->setState('Something worn');
        $auction->setPrice(340);
        $auction->setStartDate(new \DateTime('@' . strtotime('now')));
        $auction->setClosingDate(new \DateTime('2022-05-14 00:00:00'));
        $auction->setPhotosName('menina');
        $auction->setUpdateAt(new \DateTime('@' . strtotime('now')));

        $manager->persist($auction);

        $auction2 = new Auction();
        $auction2->setCategory($category2);
        $auction2->setUser($user2);
        $auction2->setTitle('The Hope Diamond');
        $auction2->setDescription('The Hope Diamond but without curse');
        $auction2->setState('In perfect state');
        $auction2->setPrice(250000000);
        $auction2->setStartDate(new \DateTime('@' . strtotime('now')));
        $auction2->setClosingDate(new \DateTime('2022-05-14 00:00:00'));
        $auction2->setPhotosName('hopediamond');
        $auction2->setUpdateAt(new \DateTime('@' . strtotime('now')));

        $manager->persist($auction2);

        $auction3 = new Auction();
        $auction3->setCategory($category3);
        $auction3->setUser($user3);
        $auction3->setTitle('The Da Vinci Code');
        $auction3->setDescription('One of the first copies');
        $auction3->setState('In perfect state');
        $auction3->setPrice(25000);
        $auction3->setStartDate(new \DateTime('@' . strtotime('now')));
        $auction3->setClosingDate(new \DateTime('2022-05-14 00:00:00'));
        $auction3->setPhotosName('davincicode');
        $auction3->setUpdateAt(new \DateTime('@' . strtotime('now')));

        $manager->persist($auction3);
        // ================================= //

        // -- UserAuction -- //
        // ================================= //
        $userAuction = new UserAuction();
        $userAuction->setBidDate(new \DateTime('@' . strtotime('now')));
        $userAuction->setBidValue(350);
        $userAuction->setAuction($auction);
        $userAuction->setUser($user4);

        $manager->persist($userAuction);

        $userAuction2 = new UserAuction();
        $userAuction2->setBidDate(new \DateTime('@' . strtotime('now')));
        $userAuction2->setBidValue(251000000);
        $userAuction2->setAuction($auction2);
        $userAuction2->setUser($user4);

        $manager->persist($userAuction2);

        $userAuction3 = new UserAuction();
        $userAuction3->setBidDate(new \DateTime('@' . strtotime('now')));
        $userAuction3->setBidValue(26000);
        $userAuction3->setAuction($auction3);
        $userAuction3->setUser($user4);

        $manager->persist($userAuction3);
        // ================================= //

        // -- UserBadge -- //
        // ================================= //
        $userBadge = new UserBadge();
        $userBadge->setAmount(1);
        $userBadge->setUser($user);
        $userBadge->setBadge($badge);

        $manager->persist($userBadge);

        $userBadge2 = new UserBadge();
        $userBadge2->setAmount(2);
        $userBadge2->setUser($user2);
        $userBadge2->setBadge($badge3);

        $manager->persist($userBadge2);

        $userBadge3 = new UserBadge();
        $userBadge3->setAmount(3);
        $userBadge3->setUser($user3);
        $userBadge3->setBadge($badge5);

        $manager->persist($userBadge3);

        // ================================= //
        $manager->flush();

        // $this->addReference(self::CATEGORY_ID_REFERENCE, $category);
        // $this->addReference(self::CATEGORY_ID_REFERENCE2, $category2);
        // $this->addReference(self::CATEGORY_ID_REFERENCE3, $category3);

        // $this->addReference(self::USER_ID_REFERENCE, $user);
        // $this->addReference(self::USER_ID_REFERENCE2, $user2);
        // $this->addReference(self::USER_ID_REFERENCE3, $user3);
    }
}
