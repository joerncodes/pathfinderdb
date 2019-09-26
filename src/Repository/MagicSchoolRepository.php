<?php

namespace App\Repository;

use App\Entity\MagicSchool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MagicSchool|null find($id, $lockMode = null, $lockVersion = null)
 * @method MagicSchool|null findOneBy(array $criteria, array $orderBy = null)
 * @method MagicSchool[]    findAll()
 * @method MagicSchool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MagicSchoolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MagicSchool::class);
    }

    // /**
    //  * @return MagicSchool[] Returns an array of MagicSchool objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MagicSchool
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
