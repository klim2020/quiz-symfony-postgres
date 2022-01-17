<?php

namespace App\Repository;

use App\Entity\Export;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Export|null find($id, $lockMode = null, $lockVersion = null)
 * @method Export|null findOneBy(array $criteria, array $orderBy = null)
 * @method Export[]    findAll()
 * @method Export[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Export::class);
    }


    function findUsingFormFilterData($filterdata){
        //if location have been selected
        if ($filterdata['location'] != 0 ) {
            $res = $this->createQueryBuilder('e')
                ->andWhere('e.Data BETWEEN :from AND :to')
                ->andWhere('l.id = :loc')
                ->leftJoin('e.Location', 'l')
                ->setParameter('from', new \DateTime($filterdata['from']->format("Y-m-d")))
                ->setParameter('to', new \DateTime($filterdata['To']->format("Y-m-d")))
                ->setParameter('loc', $filterdata['location'])
                ->getQuery()
                ->getResult();
        }else {
            //if not
            $res = $this->createQueryBuilder('e')
                ->andWhere('e.Data BETWEEN :from AND :to')
                ->leftJoin('e.Location', 'l')
                ->setParameter('from', new \DateTime($filterdata['from']->format("Y-m-d")))
                ->setParameter('to', new \DateTime($filterdata['To']->format("Y-m-d")))
                ->getQuery()
                ->getResult();
        }

        return $res;
    }

}
