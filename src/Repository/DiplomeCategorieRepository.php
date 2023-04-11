<?php

namespace App\Repository;

use App\Entity\DiplomeCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DiplomeCategorie>
 *
 * @method DiplomeCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiplomeCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiplomeCategorie[]    findAll()
 * @method DiplomeCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiplomeCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiplomeCategorie::class);
    }

    public function save(DiplomeCategorie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DiplomeCategorie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DiplomeCategorie[] Returns an array of DiplomeCategorie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DiplomeCategorie
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
