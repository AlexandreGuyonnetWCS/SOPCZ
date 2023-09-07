<?php

namespace App\Repository;

use DateTime;
use DateInterval;
use App\Entity\BaseAutorisation;
use DateTimeImmutable;
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
            ->distinct()
            ->getQuery();

        $results = $query->getResult();

        return $results;
    }

    public function getDiplomeByTypeName(string $diplomeType, string $diplomeName, string $nom, string $prenom): array
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
                'd.image',
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
            ->andWhere('d.diplomeType = :diplomeType')
            ->andWhere('d.diplomeName = :diplomeName')
            ->setParameter('diplomeType', $diplomeType)
            ->setParameter('diplomeName', $diplomeName)
            ->join('b.centre', 'c')
            ->distinct()
            ->getQuery()
            ->getResult();

        $categories = [];
        foreach ($query as $key => $value) {
            $categories[] = $value['diplomeCategory'];
        }
        $categories_string = implode(' ', $categories);

        $genre = $query[0]['genre'];
        $photo = $query[0]['photo'];
        $poste = $query[0]['poste'];
        $departement = $query[0]['departement'];
        $amco = $query[0]['amco'];
        $image = $query[0]['image'];

        $type = $query[0]['diplomeType'];

        $name = $query[0]['diplomeName'];

        $validite = [];
        foreach ($query as $key => $value) {
            $validite[] = $value['endedAt'];
        }
        $creation = $query[0]['createdAt'];

        $older_validite = $this->createQueryBuilder('b')
            ->select('MIN(b.endedAt)')
            ->join('b.employe', 'e')
            ->join('b.diplome', 'd')
            ->Where('e.nom = :nom')
            ->andWhere('e.prenom = :prenom')
            ->andWhere('d.diplomeType = :diplomeType')
            ->andWhere('d.diplomeName = :diplomeName')
            ->setParameter('nom', $nom)
            ->setParameter('prenom', $prenom)
            ->setParameter('diplomeType', $diplomeType)
            ->setParameter('diplomeName', $diplomeName)
            ->distinct()
            ->getQuery()
            ->getSingleScalarResult();

        $centre = $this->createQueryBuilder('b')
            ->select('c.nom')
            ->join('b.centre', 'c')
            ->where('b.endedAt = :older_validite')
            ->setParameter('older_validite', $older_validite)
            ->distinct()
            ->getQuery()
            ->getSingleScalarResult();

        $results = [
            'categories' => $categories_string,
            'type' => $type,
            'name' => $name,
            'validite' => $older_validite,
            'centre' => $centre,
            'nom' => $nom,
            'prenom' => $prenom,
            'genre' => $genre,
            'photo' => $photo,
            'poste' => $poste,
            'departement' => $departement,
            'amco' => $amco,
            'image' => $image,
            'creation' => $creation,

        ];

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
