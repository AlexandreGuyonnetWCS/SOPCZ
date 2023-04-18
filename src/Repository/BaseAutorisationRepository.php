<?php

namespace App\Repository;

use DateTime;
use DateInterval;
use App\Entity\BaseAutorisation;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
    public function getEmployeBaseInfo(string $nom, string $prenom): array
    {
        $query = $this->createQueryBuilder('b')
            ->select(
                'e.genre',
                'e.nom',
                'e.prenom',
                'e.amco',
                'e.poste',
                'e.departement',
                'e.photo',
                'd.diplomeType',
                'd.diplomeName',
                'd.diplomeCategory',
                'd.validite',
                'c.nom as centre',
                'b.id',
                'b.createdAt',
                'b.endedAt',
            )
            ->join('b.employe', 'e')
            ->andWhere('e.nom = :nom')
            ->andWhere('e.prenom = :prenom')
            ->setParameter('nom', $nom)
            ->setParameter('prenom', $prenom)
            ->join('b.diplome', 'd')
            ->join('b.centre', 'c')
            ->andWhere('d.diplomeType = :type')
            ->andWhere('d.diplomeName = :name')
            ->setParameter('type', 'CACES')
            ->setParameter('name', 'R482')

            ->getQuery();

        $results = $query->getResult();

        return $results;
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
