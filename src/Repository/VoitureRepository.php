<?php

namespace App\Repository;

use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Voiture::class);
    }

//    /**
//     * @return Voiture[] Returns an array of Voiture objects
//     */

    public function RecherchePlaqueRepository($value) {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT immatriculation FROM `voiture` WHERE `immatriculation` LIKE '%". $value ."%'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    /*
      public function findOneBySomeField($value): ?Voiture
      {
      return $this->createQueryBuilder('v')
      ->andWhere('v.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */
}
