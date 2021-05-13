<?php

namespace App\Repository;

use App\Entity\Grupo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Grupo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grupo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grupo[]    findAll()
 * @method Grupo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrupoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Grupo::class);
    }
    
    public function paginate($dql, $page = 1, $limit = 3) {
        $paginator = new Paginator($dql);

        $paginator->getQuery()
                ->setFirstResult($limit * ($page - 1)) // Offset
                ->setMaxResults($limit); // Limit

        return $paginator;
    }

    // /**
    //  * @return Grupo[] Returns an array of Grupo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Grupo
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function findOneShowById($id) {

        $qb = $this->createQueryBuilder('g');
        $qb->where('g.id = :tid')
            ->andWhere('g.tipo = 1')
            ->setParameter('tid', $id);
        return $qb->getQuery()->getOneOrNullResult();
    }
    
    public function findOneSagaById($id) {

        $qb = $this->createQueryBuilder('g');
        $qb->where('g.id = :tid')
            ->andWhere('g.tipo = 0')
            ->setParameter('tid', $id);
        return $qb->getQuery()->getOneOrNullResult();
    }
    
    //Search function
    public function findBySearchMasterQueryGroup($inOrder, $inSearch, $grupoType, $pagCurrent = 1, $pagLimit = 20) {
        $qb = $this->createQueryBuilder('g');
        //Well formed show (to access later in twig)
        $qb->andWhere($qb->expr()->eq('g.tipo', $grupoType));
        //Order (Only A-Z(default) & Z-A)
        if ($inOrder == 'RALP') {
            $qb->orderBy('g.titulo', 'DESC');
        } else {
            $qb->orderBy('g.titulo', 'ASC');
        }
        //Name search
        $qb->andWhere($qb->expr()->like('g.titulo', ':src'));
        $qb->setParameter('src', '%'.$inSearch.'%');
        $paginator = $this->paginate($qb, $pagCurrent, $pagLimit);
        return $paginator;
    }
    
}
