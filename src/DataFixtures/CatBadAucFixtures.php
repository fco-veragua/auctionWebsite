<?php

namespace App\DataFixtures;

use App\Entity\Badge;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CatBadAucFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
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
        
        $manager->flush();
    }
}
