<?php

namespace App\DataFixtures;

use App\Entity\Auction;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuctionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // -- Auction -- //
        // ================================= //
        $auction = new Auction();
        $auction->setCategory($this->getReference(EntityFixtures::CATEGORY_ID_REFERENCE));
        $auction->setUser($this->getReference(EntityFixtures::USER_ID_REFERENCE));
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
        $auction->setCategory($this->getReference(EntityFixtures::CATEGORY_ID_REFERENCE2));
        $auction->setUser($this->getReference(EntityFixtures::USER_ID_REFERENCE2));
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
        $auction->setCategory($this->getReference(EntityFixtures::CATEGORY_ID_REFERENCE3));
        $auction->setUser($this->getReference(EntityFixtures::USER_ID_REFERENCE3));
        $auction3->setTitle('The Da Vinci Code');
        $auction3->setDescription('One of the first copies');
        $auction3->setState('In perfect state');
        $auction3->setPrice(25000);
        $auction3->setStartDate(new \DateTime('@' . strtotime('now')));
        $auction3->setClosingDate(new \DateTime('2022-05-14 00:00:00'));
        $auction3->setPhotosName('davincicode');
        $auction3->setUpdateAt(new \DateTime('@' . strtotime('now')));

        $manager->persist($auction3);

        $manager->flush();
    }

    public function getDependencies() // To load this fixture after the one indicated
    {
        return [
            EntityFixtures::class
        ];
    }
}
