<?php

namespace App\Repository;

use App\Entity\NumeroHabilitation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NumeroHabilitation>
 *
 * @method NumeroHabilitation|null find($id, $lockMode = null, $lockVersion = null)
 * @method NumeroHabilitation|null findOneBy(array $criteria, array $orderBy = null)
 * @method NumeroHabilitation[]    findAll()
 * @method NumeroHabilitation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NumeroHabilitationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NumeroHabilitation::class);
    }

    public function save(NumeroHabilitation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NumeroHabilitation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getNumberHabilitation(string $employeNom, string $employePrenom): array
    {
        $query = $this->createQueryBuilder('n')
            ->select(
                'n.number',
                'c.nom as centre',
            )
            ->join('n.employe', 'e')
            ->join('n.centre', 'c')
            ->andWhere('e.nom = :employeNom')
            ->andWhere('e.prenom = :employePrenom')
            ->setParameter('employeNom', $employeNom)
            ->setParameter('employePrenom', $employePrenom)
            ->getQuery()
            ->getResult();

        return $query;
    }

//    /**
//     * @return NumeroHabilitation[] Returns an array of NumeroHabilitation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NumeroHabilitation
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
