<?php

namespace App\Repository;

use App\Entity\Offres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Offres>
 *
 * @method Offres|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offres|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offres[]    findAll()
 * @method Offres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offres::class);
    }
   
     /*@return JobOffer[] Returns an array of Offer objects*/
      public function findTenAll(): array
      {
       return $this->createQueryBuilder('o')
       ->setMaxResults(10)
       ->getQuery()
       ->getResult();
    }
    
     /*@return JobOffer[] Returns an array of Offer objects*/
     public function findTenByCreatedAt(): array
     {
      return $this->createQueryBuilder('o')
      ->orderBy('o.createdAt', 'DESC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult();
    }

    public function findPreviousOffre(Offres $offre): ?Offres
    {
        return $this->createQueryBuilder('o')
            ->where('o.id < :currentId')
            ->setParameter('currentId', $offre->getId())
            ->orderBy('o.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findNextOffre(Offres $offre): ?Offres
    {
        return $this->createQueryBuilder('o')
            ->where('o.id > :currentId')
            ->setParameter('currentId', $offre->getId())
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    //    /**
    //     * @return Offres[] Returns an array of Offres objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Offres
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
