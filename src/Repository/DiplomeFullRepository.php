<?php

namespace App\Repository;

use App\Entity\DiplomeFull;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DiplomeFull>
 *
 * @method DiplomeFull|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiplomeFull|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiplomeFull[]    findAll()
 * @method DiplomeFull[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiplomeFullRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiplomeFull::class);
    }

    public function save(DiplomeFull $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DiplomeFull $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


//    /**
//     * @return DiplomeFull[] Returns an array of DiplomeFull objects
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

//    public function findOneBySomeField($value): ?DiplomeFull
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
