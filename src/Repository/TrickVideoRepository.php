<?php

namespace App\Repository;

use App\Entity\TrickVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TrickVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrickVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrickVideo[]    findAll()
 * @method TrickVideo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrickVideoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TrickVideo::class);
    }

//    /**
//     * @return FigureVideo[] Returns an array of FigureVideo objects
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
    public function findOneBySomeField($value): ?FigureVideo
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
