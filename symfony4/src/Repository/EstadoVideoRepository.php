<?php

namespace App\Repository;

use App\Entity\EstadoVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method TiempoVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method TiempoVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method TiempoVideo[]    findAll()
 * @method TiempoVideo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoVideoRepository extends ServiceEntityRepository
{
    
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EstadoVideo::class);
    }
    
    public function paginate($dql, $page = 1, $limit = 3) {
        $paginator = new Paginator($dql);

        $paginator->getQuery()
                ->setFirstResult($limit * ($page - 1)) // Offset
                ->setMaxResults($limit); // Limit

        return $paginator;
    }

    // /**
    //  * @return TiempoVideo[] Returns an array of TiempoVideo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TiempoVideo
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function findByUserCompletion($uid, $limit) {
        $qb = $this->createQueryBuilder('e');
        $query = $qb
            ->join('e.usuario', 'u')
            ->where('u.id = :uid')
            ->andWhere($qb->expr()->neq('e.completo', ':nt'))
            ->orderBy('e.porcentaje', 'DESC')
            ->setMaxResults($limit)
            ->setParameters(['uid' => $uid, 'nt' => true])
            ->getQuery();
            
        return $query->getResult();
    }
    
    public function findByUserVideoStatus($vid, $uid) {
        $qb = $this->createQueryBuilder('e');
        $query = $qb
            ->join('e.usuario', 'u')
            ->join('e.video', 'v')
            ->where('u.id = :uid')
            ->andWhere('v.id = :vid')
            ->setParameters(['uid' => $uid, 'vid' => $vid])
            ->getQuery();
            
        return $query->getOneOrNullResult();
    }
    
    public function findByUserId($eid, $uid) {
        $qb = $this->createQueryBuilder('e');
        $query = $qb
            ->where('e.usuario = :uid')
            ->andWhere('e.id = :vid')
            ->setParameters(['uid' => $uid, 'vid' => $eid])
            ->getQuery();
            
        return $query->getOneOrNullResult();
    }
    
    
    public function findAllByUser($uid) { //Deprecate soon
        $qb = $this->createQueryBuilder('e');
        $query = $qb
            ->join('e.usuario', 'u')
            ->join('e.video', 'v')
            ->where('u.id = :uid')
            ->orderBy('e.porcentaje', 'DESC')
            ->addOrderBy('v.titulo', 'ASC')
            ->setParameter('uid', $uid)
            ->getQuery();
            
        return $query->getResult();
    }
    
    public function findAllByUserPaged($uid,$pagCurrent,$pagLimit) {
        $qb = $this->createQueryBuilder('e');
        $qb->join('e.usuario', 'u')
            ->join('e.video', 'v')
            ->where('u.id = :uid')
            ->orderBy('e.modificado', 'DESC')
            ->setParameter('uid', $uid);
        
        $paginator = $this->paginate($qb, $pagCurrent, $pagLimit);
        return $paginator;
    }
    
    // Browse /show megafunction
    public function findByLatestUpdatedTimeAndShow($uid, $sid) {
        $qb = $this->createQueryBuilder('e');
        $qb->addSelect('MAX(e.modificado) AS HIDDEN max_upd');
        
        //Videos of the currently logged in user
        $qb->innerJoin('e.usuario', 'u')
            ->where('u.id = :uid');
            
        //with a show id
        $qb->innerJoin('e.video', 'v');
        $qb->innerJoin('v.grupo', 'g');
        $qb->andWhere('g.tipo = :tid')
            ->andWhere('v.grupo = :sid');
        $qb->setParameters(['uid' => $uid, 'tid' => 1, 'sid' => $sid])
            ->orderBy('max_upd', 'DESC')
            ->groupBy('e.id')
            ->setMaxResults(1);
            
        return $qb->getQuery()->getOneOrNullResult();
    }
}
