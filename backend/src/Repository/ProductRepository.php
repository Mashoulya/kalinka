<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

       /**
        * @return Product[] Returns an array of Product objects
        */
       public function findAllWithUnitAndPhotos(): array
       {
           return $this->createQueryBuilder('p')
               ->leftJoin('p.unit', 'u')
               ->addSelect('u')
               ->leftJoin('p.photos', 'ph')
               ->addSelect('ph')
               ->orderBy('p.id', 'ASC')
               ->getQuery()
               ->getResult()
           ;
       }

       /**
        * @return Product[] Returns an array of Product objects
        */
       public function findProductsBySubcategory(string $subcategorySlug): array
       {
           return $this->createQueryBuilder('p')
               ->leftJoin('p.unit', 'u')
               ->addSelect('u')
               ->leftJoin('p.photos', 'ph')
               ->addSelect('ph')
               ->leftJoin('p.subcategory', 's')
               ->andWhere('s.slug = :subcategorySlug')
               ->setParameter('subcategorySlug', $subcategorySlug)
               ->orderBy('p.id', 'ASC')
               ->getQuery()
               ->getResult()
           ;
       }
}
