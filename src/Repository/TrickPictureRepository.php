<?php

namespace App\Repository;

use App\Entity\TrickMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TrickMedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrickMedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrickMedia[]    findAll()
 * @method TrickMedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrickPictureRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TrickMedia::class);
    }

//    /**
//     * @return FigurePicture[] Returns an array of FigurePicture objects
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
    public function findOneBySomeField($value): ?FigurePicture
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
