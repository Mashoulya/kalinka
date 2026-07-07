<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
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
           return $this->findProductsWithAllRelations()
               ->orderBy('p.id', 'ASC')
               ->getQuery()
               ->getResult()
           ;
       }

       /**
        * @return Product[] Returns an array of Product objects
        */
       public function findProductsBySubcategory(int $subcategoryId): array
       {
           return $this->findProductsWithAllRelations()
               ->andWhere('s.id = :subcategoryId')
               ->setParameter('subcategoryId', $subcategoryId)
               ->orderBy('p.id', 'ASC')
               ->getQuery()
               ->getResult()
           ;
       }

       public function findOneBySlugWithRelations(string $slug): ?Product
       {
           return $this->findProductsWithAllRelations()
               ->andWhere('p.slug = :slug')
               ->setParameter('slug', $slug)
               ->getQuery()
               ->getOneOrNullResult()
           ;
       }

       private function findProductsWithAllRelations(): QueryBuilder
       {
           return $this->createQueryBuilder('p')
               ->leftJoin('p.unit', 'u')
               ->addSelect('u')
               ->leftJoin('p.photos', 'ph')
               ->addSelect('ph')
               ->leftJoin('p.subcategory', 's')
               ->addSelect('s')
               ->leftJoin('s.category', 'c')
               ->addSelect('c');
       }
}
