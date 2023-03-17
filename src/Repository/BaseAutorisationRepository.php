<?php

namespace App\Repository;

use App\Entity\BaseAutorisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BaseAutorisation>
 *
 * @method BaseAutorisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method BaseAutorisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method BaseAutorisation[]    findAll()
 * @method BaseAutorisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaseAutorisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BaseAutorisation::class);
    }

    public function save(BaseAutorisation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BaseAutorisation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByNomEtPrenom(string $nom, string $prenom): array
    {

        return $this->createQueryBuilder('b')
            ->join('b.employe', 'e')
            ->andWhere('e.nom = :nom')
            ->andWhere('e.prenom = :prenom')
            ->setParameter('nom', $nom)
            ->setParameter('prenom', $prenom)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return BaseAutorisation[] Returns an array of BaseAutorisation objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?BaseAutorisation
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
