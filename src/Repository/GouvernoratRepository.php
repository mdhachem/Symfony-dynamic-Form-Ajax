<?php

namespace App\Repository;

use App\Entity\Gouvernorat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Gouvernorat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gouvernorat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gouvernorat[]    findAll()
 * @method Gouvernorat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GouvernoratRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Gouvernorat::class);
    }

    // /**
    //  * @return Gouvernorat[] Returns an array of Gouvernorat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gouvernorat
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
