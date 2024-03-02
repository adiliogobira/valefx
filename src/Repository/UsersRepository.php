<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Users>
 *
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
        $this->registry = $registry;
    }

    private function conn(){
        return $this->registry->getManager('default');
    }

    public function findByEmail(string $email){
        $user = new Users();
        $user->findBy(['email' => $email]);
        $sql = "SELECT id, name, lastname, email, access_level, status
        FROM users
        WHERE email = '{$email}'";
        
        $query = $this->conn()->query($sql);
        return $query->fetch();
    }

//    /**
//     * @return Users[] Returns an array of Users objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Users
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
