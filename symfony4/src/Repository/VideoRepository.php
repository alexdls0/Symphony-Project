<?php

namespace App\Repository;

use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Video::class);
    }
    
    public function paginate($dql, $page = 1, $limit = 3) {
        $paginator = new Paginator($dql);

        $paginator->getQuery()
                ->setFirstResult($limit * ($page - 1)) // Offset
                ->setMaxResults($limit); // Limit

        return $paginator;
    }

    // /**
    //  * @return Video[] Returns an array of Video objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Video
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function findUserFan($uid, $vid) {
        $qb = $this->createQueryBuilder('v');
        $qb->innerJoin('v.fans', 'f')
           ->where($qb->expr()->eq('f.id', $uid))
           ->andWhere($qb->expr()->eq('v.id', $vid));
        return $qb->getQuery()->getOneOrNullResult();
    }
    
    public function findAllByUserFan($uid) {
        $qb = $this->createQueryBuilder('v');
        $qb->innerJoin('v.fans', 'f')
           ->where($qb->expr()->eq('f.id', $uid))
           ->orderBy('v.titulo','ASC');
        return $qb->getQuery()->getResult();
    }
    
    public function findAllByUserFanPaged($uid,$pagCurrent,$pagLimit) {
        $qb = $this->createQueryBuilder('v');
        $qb->innerJoin('v.fans', 'f')
           ->where($qb->expr()->eq('f.id', $uid))
           ->orderBy('v.titulo','ASC');
        $paginator = $this->paginate($qb, $pagCurrent, $pagLimit);
        return $paginator;
    }
    
    public function listVideosByFans($limit) {
        $qb = $this->createQueryBuilder('v');
        $qb->addSelect('COUNT(f.id) as nFans')
            ->join('v.fans', 'f')
            ->groupBy('v.id')
            ->orderBy("nFans", 'DESC')
           ->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }
    
    public function findByUserComplete($uid) {
        $qb = $this->createQueryBuilder('v');
        $qb->innerJoin('v.estadoVideos', 'e')
            ->innerJoin('e.usuario', 'u')
            ->where($qb->expr()->eq('e.completo', ':st'))
            ->andWhere('u.id = :uid')
            ->setParameters(['uid' => $uid, 'st' => true ]);
        return $qb->getQuery()->getResult();
    }
    
    public function findByCategoryArrayNotComplete($uid, $cats,$limit, $gid = null) {
        $qb = $this->createQueryBuilder('v');
        $qb->addSelect('RAND() as HIDDEN rand')->orderBy('rand');
        $qb->innerJoin('v.categorias', 'c')
            ->leftJoin('v.estadoVideos', 'e')
            ->innerJoin('e.usuario', 'u')
            ->where($qb->expr()->in('c.id', $cats))
            ->andWhere($qb->expr()->eq('e.completo', ':st'));
        if ($gid) {
            $qb->andWhere($qb->expr()->neq('v.grupo', $gid));
        }
        $qb->andWhere('u.id = :uid')
            ->setParameters(['uid' => $uid, 'st' => false ]);
            
            $qb->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }
    
    
    public function findByDateLatestOrder($uid,$limit) {
        
        $qb = $this->createQueryBuilder('v');

        /*
        $qb->leftJoin('v.estadoVideos', 'e')
            ->innerJoin('e.usuario', 'u')
            ->where($qb->expr()->eq('e.completo', ':st'))
            ->andWhere('u.id = :uid')
            ->setParameters(['uid' => $uid, 'st' => 0 ]);*/
            
        $qb->andWhere($qb->expr()->lt('v.fechaonline', ':dt'))
            ->orderBy('v.fechaonline', 'DESC')
            ->setMaxResults($limit)
            ->setParameter('dt', new \DateTime());
        return $qb->getQuery()->getResult();
    }
    
    public function findByPremiumOnlyRand($uid,$limit) {
        
        $qb = $this->createQueryBuilder('v');
        $qb->addSelect('RAND() as HIDDEN rand')->orderBy('rand');
        $qb->andWhere($qb->expr()->eq('v.premium', 1));
        $qb->andWhere($qb->expr()->lt('v.fechaonline', ':dt'))
            ->setMaxResults($limit)
            ->setParameter('dt', new \DateTime());
        return $qb->getQuery()->getResult();
    }
    
    public function findByDateUpcomingOrder($limit) {
        $qb = $this->createQueryBuilder('v');
        $qb->where($qb->expr()->gte('v.fechaonline', ':dt'))
            ->orderBy('v.fechaonline', 'ASC')
            ->setMaxResults($limit)
            ->setParameter('dt', new \DateTime('-5 seconds'));
            
        return $qb->getQuery()->getResult();
    }
    
    //Saga list
    public function findAllMoviesOfTypePaged($sid, $pagCurrent, $pagLimit, $type) {
        $qb = $this->createQueryBuilder('v');
        $qb->innerJoin('v.grupo', 'g');
        
        $qb->where($qb->expr()->eq('g.id', ':gid'));
        $qb->setParameter('gid', $sid);
        
        $qb->andWhere($qb->expr()->eq('g.tipo', ':gtyp'));
        $qb->setParameter('gtyp', $type);
        
        $paginator = $this->paginate($qb, $pagCurrent, $pagLimit);
        return $paginator;
    }
    
    //Director list
    public function findAllVideosOfDirectorPaged($did, $pagCurrent, $pagLimit) {
        $qb = $this->createQueryBuilder('v');
        $qb->innerJoin('v.director', 'd');
        
        $qb->where($qb->expr()->eq('d.id', ':did'));
        $qb->setParameter('did', $did);
        
        $paginator = $this->paginate($qb, $pagCurrent, $pagLimit);
        return $paginator;
    }
    
    //Producer list
    public function findAllVideosOfProducerPaged($pid, $pagCurrent, $pagLimit) {
        $qb = $this->createQueryBuilder('v');
        $qb->innerJoin('v.productor', 'p');
        
        $qb->where($qb->expr()->eq('p.id', ':pid'));
        $qb->setParameter('pid', $pid);
        
        $paginator = $this->paginate($qb, $pagCurrent, $pagLimit);
        return $paginator;
    }
    
    //Category list
    public function findAllVideosOfCategoryPaged($cid, $pagCurrent, $pagLimit) {
        $qb = $this->createQueryBuilder('v');
        $qb->innerJoin('v.categorias', 'c');
        
        $qb->where($qb->expr()->eq('c.id', ':cid'));
        $qb->setParameter('cid', $cid);
        
        $paginator = $this->paginate($qb, $pagCurrent, $pagLimit);
        return $paginator;
    }
    
    //Browse functions
    public function findBySearchMasterQuery($uid, $inOrder, $inPremium, $inComplete, $inWatching, $inAge, $inCateg, $inDir, $inProd, $inSearch, $videoType, $pagCurrent, $pagLimit) {
        $qb = $this->createQueryBuilder('v');
        //Order
        if ($inOrder == 'ALP') {
            $qb->orderBy('v.titulo', 'ASC');
        } else if ($inOrder == 'RALP') {
            $qb->orderBy('v.titulo', 'DESC');
        } else if ($inOrder == 'RDATE') {
            $qb->orderBy('v.fecharodada', 'DESC');
        } else {
            $qb->orderBy('v.fechaonline', 'DESC');
        }
        //Premium check
        if ($inPremium) {
            $qb->andWhere($qb->expr()->eq('v.premium', 1));
        }
        //Complete and watch check
        if ($inComplete || $inWatching) {
                $qb->innerJoin('v.estadoVideos', 'e');
                $qb->andWhere($qb->expr()->eq('e.usuario', ':myuid')); 
                $qb->setParameter('myuid', $uid);
        }
        if ($inComplete) {
            $qb->andWhere($qb->expr()->eq('e.completo', ':comp'));
            $qb->setParameter('comp', '1');
        }
        if ($inWatching) {
            $qb->andWhere($qb->expr()->gt('e.porcentaje', ':prc'));
            $qb->setParameter('prc', '0');
        }
        
        //Age check
        if ($inAge) {
            $qb->andWhere($qb->expr()->gte('v.edad', $inAge));
        }
        //Categories
        if ($inCateg) {
            $qb->innerJoin('v.categorias', 'c');
            $qb->andWhere($qb->expr()->in('c.id', $inCateg));
        }
        //Directors
        if ($inDir) {
            $qb->andWhere($qb->expr()->in('v.director', $inDir));
        }
        //Producers
        if ($inProd) {
            $qb->andWhere($qb->expr()->in('v.productor', $inProd));
        }
        //Search by name
        if ($inSearch) {
            $qb->andWhere($qb->expr()->like('v.titulo', ':src'));
            $qb->setParameter('src', '%'.$inSearch.'%');
        }
        //Videotype
        if ($videoType !== null) {
            $qb->andWhere($qb->expr()->eq('v.tipo', $videoType));
        }
        
        $paginator = $this->paginate($qb, $pagCurrent, $pagLimit);
        return $paginator;
    }
    
    //Season browse
    public function findBySeasonShowPaged($sid,$gid,$pagCurrent,$pagLimit)
    {
        $qb = $this->createQueryBuilder('v');
        $qb->innerJoin('v.grupo', 'g');
        
        $qb->where($qb->expr()->eq('g.id', ':gid'));
        $qb->setParameter('gid', $gid);
        $qb->andWhere($qb->expr()->eq('g.tipo', ':gtyp'));
        $qb->setParameter('gtyp', 1);
        
        $qb->andWhere($qb->expr()->eq('v.temporada', ':tmp'));
        $qb->setParameter('tmp', $sid);
        $qb->orderBy('v.fecharodada', 'ASC');
        
        $paginator = $this->paginate($qb, $pagCurrent, $pagLimit);
        return $paginator;
    }


    //Next and previous
    public function findNextVideo($vid,$frod,$tid) {
        $qb = $this->createQueryBuilder('v');
        $qb->where($qb->expr()->eq('v.temporada', ':tid'));
        $qb->setParameter('tid', $tid);
        $qb->andWhere($qb->expr()->gte('v.fecharodada', ':dt'))
            ->orderBy('v.fecharodada', 'ASC')
            ->setMaxResults(1)
            ->setParameter('dt', $frod);
        $qb->andWhere($qb->expr()->neq('v.id', ':vid'));
        $qb->setParameter('vid', $vid);

        return $qb->getQuery()->getOneOrNullResult();
    }
    
    public function findPreVideo($vid,$frod,$tid) {
        $qb = $this->createQueryBuilder('v');
        $qb->where($qb->expr()->eq('v.temporada', ':tid'));
        $qb->setParameter('tid', $tid);
        $qb->andWhere($qb->expr()->lt('v.fecharodada', ':dt'))
            ->orderBy('v.fecharodada', 'DESC')
            ->setMaxResults(1)
            ->setParameter('dt', $frod);
        $qb->andWhere($qb->expr()->neq('v.id', ':vid'));
        $qb->setParameter('vid', $vid);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
