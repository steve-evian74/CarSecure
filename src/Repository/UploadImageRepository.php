<?php

namespace App\Repository;

use App\Entity\UploadImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeIntervention|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeIntervention|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeIntervention[]    findAll()
 * @method TypeIntervention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UploadImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UploadImage::class);
    }

//    /**
//     * @return UploadImage[] Returns an array of UploadImage objects
//     */
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
    public function findOneBySomeField($value): ?UploadImage
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
