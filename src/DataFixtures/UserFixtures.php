<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('gagosiangallery@gmail.com');
        $user->setPassword('gagosian1234');
        $user->setUserName('gagosianGallery');
        $user->setName('Larry');
        $user->setLastName('Gagosian');
        $user->setBirthDate(new DateTime('1987-11-1'));
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
        $user2->setBirthDate(new DateTime('1970-11-1'));
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
        $user3->setBirthDate(new DateTime('1982-11-1'));
        $user3->setCountry('Portugal');
        $user3->setPostalCode(40501);
        $user3->setStreetAddress('R. das Carmelitas');
        $user3->setCompanyName('Livraria Lello');
        $user3->setPhoneNumber(777888999);

        $manager->persist($user3);

        $manager->flush();
    }
}
