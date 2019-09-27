<?php

namespace App\Repository;

use App\Entity\SpellClassLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SpellClassLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpellClassLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpellClassLevel[]    findAll()
 * @method SpellClassLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpellClassLevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpellClassLevel::class);
    }

    // /**
    //  * @return SpellClassLevel[] Returns an array of SpellClassLevel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SpellClassLevel
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
