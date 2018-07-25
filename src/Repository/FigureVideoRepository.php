<?php

namespace App\Repository;

use App\Entity\FigureVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FigureVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method FigureVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method FigureVideo[]    findAll()
 * @method FigureVideo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FigureVideoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FigureVideo::class);
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
