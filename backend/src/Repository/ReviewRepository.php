<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Review>
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

       /**
        * @return Review[] Returns an array of Review objects
        */
       public function findPositiveReviews(int $minRating = 4): array
       {
           return $this->createQueryBuilder('r')
               ->andWhere('r.rating >= :min')
               ->andWhere('LENGTH(r.comment) <= :maxLength')
               ->setParameter('min', $minRating)
               ->setParameter('maxLength', 380)
               ->orderBy('r.id', 'DESC')
               ->setMaxResults(10)
               ->getQuery()
               ->getResult()
           ;
       }
}
