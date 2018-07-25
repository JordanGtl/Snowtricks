<?php

namespace App\Repository;

use App\Entity\FigurePicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FigurePicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method FigurePicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method FigurePicture[]    findAll()
 * @method FigurePicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FigurePictureRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FigurePicture::class);
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
