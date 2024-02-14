<?php

namespace App\Repository;

use App\Entity\MarketingUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MarketingUsers>
 *
 * @method MarketingUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarketingUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarketingUsers[]    findAll()
 * @method MarketingUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarketingUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarketingUsers::class);
    }

//    /**
//     * @return MarketingUsers[] Returns an array of MarketingUsers objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MarketingUsers
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
