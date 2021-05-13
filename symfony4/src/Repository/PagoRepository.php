<?php

namespace App\Repository;

use App\Entity\Pago;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Pago|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pago|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pago[]    findAll()
 * @method Pago[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PagoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pago::class);
    }
    
    public function paginate($dql, $page = 1, $limit = 3) {
        $paginator = new Paginator($dql);

        $paginator->getQuery()
                ->setFirstResult($limit * ($page - 1)) // Offset
                ->setMaxResults($limit); // Limit

        return $paginator;
    }

    // /**
    //  * @return Pago[] Returns an array of Pago objects
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
    public function findOneBySomeField($value): ?Pago
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    //TODO: Deprecate
    public function findAllByUserDate($uid)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.cuentausuario = :val')
            ->setParameter('val', $uid)
            ->orderBy('p.fecha', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findAllByUserDatePaged($uid,$pagCurrent,$pagLimit)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.cuentausuario = :val')
            ->setParameter('val', $uid)
            ->orderBy('p.fecha', 'DESC');
        $paginator = $this->paginate($qb, $pagCurrent, $pagLimit);
        return $paginator;
    }
}
