<?php

namespace App\Repository;

use App\Entity\CharacterClassAdvancement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CharacterClassAdvancement|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacterClassAdvancement|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacterClassAdvancement[]    findAll()
 * @method CharacterClassAdvancement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterClassAdvancementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacterClassAdvancement::class);
    }

    // /**
    //  * @return CharacterClassAdvancement[] Returns an array of CharacterClassAdvancement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CharacterClassAdvancement
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
