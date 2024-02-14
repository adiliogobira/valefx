<?php

namespace App\Repository;

use App\Entity\Apport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Apport>
 *
 * @method Apport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apport[]    findAll()
 * @method Apport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApportRepository extends ServiceEntityRepository
{
    public $conn;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apport::class);
        $this->conn = $this->getEntityManager()->getConnection();
    }

    public function blockBoxes($userId, $budget = '>')
    {

        $sql = "SELECT p.id, user_id, SUM(value) AS value, data_aport, p.created_at, SUM(ap.budget) AS budget
        FROM apport p
        LEFT JOIN applications ap ON p.id = ap.apport_id
        WHERE ap.budget $budget 0
        ";

        $query = $this->conn->executeQuery($sql);
        return $query->fetchAssociative();
    }

    public function blockSaldo($userId)
    {

        $sql = "SELECT p.id, user_id, value, data_aport, p.created_at
        FROM apport p

        WHERE MONTH(created_at) = 3
        ";

        $query = $this->conn->executeQuery($sql);
        return $query->fetchAssociative();
    }

//    /**
//     * @return Apport[] Returns an array of Apport objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Apport
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
