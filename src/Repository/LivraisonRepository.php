<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Livraison;

class LivraisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livraison::class);
    }
    public function getAddressStatistics(): array
    {
        return $this->createQueryBuilder('l')
            ->select('l.adresselivraison, COUNT(l.id) as totalDeliveries')
            ->groupBy('l.adresselivraison')
            ->getQuery()
            ->getResult();
    }
    

  }
