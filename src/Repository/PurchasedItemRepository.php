<?php

namespace App\Repository;

use App\Entity\PurchasedItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PurchasedItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method PurchasedItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method PurchasedItem[]    findAll()
 * @method PurchasedItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PurchasedItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PurchasedItem::class);
    }

    // /**
    //  * @return PurchasedItem[] Returns an array of PurchasedItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PurchasedItem
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
