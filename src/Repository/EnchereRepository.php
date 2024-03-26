<?php

namespace App\Repository;

use App\Entity\Enchere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Enchere>
 *
 * @method Enchere|null find($id, $lockMode = null, $lockVersion = null)
 * @method Enchere|null findOneBy(array $criteria, array $orderBy = null)
 * @method Enchere[]    findAll()
 * @method Enchere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnchereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Enchere::class);
    }

    /**
     * @return Enchere[] Returns an array of Enchere objects
     */
   // public function findByExampleField($value): array
    //{
       // return $this->createQueryBuilder('p')
         //   ->andWhere('p.exampleField = :val')
         //   ->setParameter('val', $value)
         //   ->orderBy('p.id', 'ASC')
          //  ->setMaxResults(10)
          //  ->getQuery()
          //  ->getResult();
   // }

   // public function findOneBySomeField($value): ?Enchere
    //{
       // return $this->createQueryBuilder('p')
    //        ->andWhere('p.exampleField = :val')
     //       ->setParameter('val', $value)
      //      ->getQuery()
          //  ->getOneOrNullResult();
  // }
}