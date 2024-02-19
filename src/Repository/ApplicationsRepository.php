<?php

namespace App\Repository;

use App\Entity\Applications;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Applications>
 *
 * @method Applications|null find($id, $lockMode = null, $lockVersion = null)
 * @method Applications|null findOneBy(array $criteria, array $orderBy = null)
 * @method Applications[]    findAll()
 * @method Applications[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationsRepository extends ServiceEntityRepository
{
    public $conn;
    private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Applications::class);

        $this->registry = $registry;

        $this->conn = $this->getEntityManager()->getConnection();
    }

    private function getConn($uf = null)
    {
        return $this->registry->getManager()->getConnection();
    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function setConection()
    {
        $this->conn = $this->registry->getManager()->getConnection();
        return $this;
    }

    public function listaAplicacao($userId = null)
    {

        $sql = "SELECT p.id, CONCAT(u.name, ' ', u.lastname) as cliente, p.value,
        ap.budget,
        p.data_aport, p.created_at,
        ROUND(((ap.budget / p.value) * 100), 2) as percentual
        FROM apport p
        LEFT JOIN applications ap ON p.id = ap.apport_id
        JOIN users u ON u.id = p.user_id
        ";
        if (!is_null($userId)) {
            $sql .= " WHERE p.user_id = $userId";
        }

        $query = $this->conn->executeQuery($sql);
        return $query->fetchAllAssociative();
    }

    public function listaAtivos()
    {

        $sql = "SELECT active_name, active_abreviate, active_status
        FROM actives";

        $query = $this->conn->executeQuery($sql);
        return $query->fetchAllAssociative();
    }

//    /**
//     * @return Applications[] Returns an array of Applications objects
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

//    public function findOneBySomeField($value): ?Applications
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
