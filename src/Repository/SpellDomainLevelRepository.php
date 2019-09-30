<?php

namespace App\Repository;

use App\Entity\SpellDomainLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SpellDomainLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpellDomainLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpellDomainLevel[]    findAll()
 * @method SpellDomainLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpellDomainLevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpellDomainLevel::class);
    }

    // /**
    //  * @return SpellDomainLevel[] Returns an array of SpellDomainLevel objects
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
    public function findOneBySomeField($value): ?SpellDomainLevel
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
