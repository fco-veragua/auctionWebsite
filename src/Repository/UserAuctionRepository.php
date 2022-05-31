<?php

namespace App\Repository;

use App\Entity\UserAuction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserAuction>
 *
 * @method UserAuction|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserAuction|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserAuction[]    findAll()
 * @method UserAuction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserAuctionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserAuction::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(UserAuction $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(UserAuction $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return UserAuction[] Returns an array of UserAuction objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserAuction
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    // /**
    //  * @return UserAuction[]
    //  */
    // public function findTopBid(int $auction): array
    // {
    //     $entityManager = $this->getEntityManager();

    //     $query = $entityManager->createQuery(
    //         'SELECT b
    //         FROM App\Entity\UserAuction b
    //         JOIN App\Entity
    //         WHERE a.closingDate <= CURRENT_TIMESTAMP()'
    //     );

    //     // returns an array of Product objects
    //     return $query->getResult();
    // }
}
