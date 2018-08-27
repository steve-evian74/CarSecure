<?php

namespace App\Repository;

use App\Entity\FkUploadImage2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FkUploadImage2|null find($id, $lockMode = null, $lockVersion = null)
 * @method FkUploadImage2|null findOneBy(array $criteria, array $orderBy = null)
 * @method FkUploadImage2[]    findAll()
 * @method FkUploadImage2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FkUploadImage2Repository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FkUploadImage2::class);
    }

//    /**
//     * @return FkUploadImage2[] Returns an array of FkUploadImage2 objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FkUploadImage2
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
