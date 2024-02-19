<?php

namespace App\Repository;

use App\Entity\Voitures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Voitures>
 *
 * @method Voitures|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voitures|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voitures[]    findAll()
 * @method Voitures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoituresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voitures::class);
    }

    public function searchCars($marque, $prix, $energie, $kilometres)
    {
        $queryBuilder = $this->createQueryBuilder('v');
        
        if ($marque !== null) {
            $queryBuilder->andWhere('v.marque LIKE :marque')
                         ->setParameter('marque', '%' . $marque . '%');
        }

        // if ($energie !== null) {
        //     $queryBuilder->andWhere('v.energie = :energie')
        //                  ->setParameter('energie', $energie);
        // }
        
        // if ($kilometres !== null) {
        //     switch ($kilometres) {
        //         case '15000':
        //             $queryBuilder->andWhere('v.km <= 15000');
        //             break;
        //         case '15000-30000':
        //             $queryBuilder->andWhere('v.km >= 15000 AND v.km < 30000');
        //             break;
        //         case '30000-60000':
        //             $queryBuilder->andWhere('v.km >= 30000 AND v.km < 60000');
        //             break;
        //         case '60000-120000':
        //             $queryBuilder->andWhere('v.km >= 60000 AND v.km < 120000');
        //             break;
        //         case '120000':
        //             $queryBuilder->andWhere('v.km >= 120000');
        //             break;
        //         default:
        //             // Si la valeur de kilométrage n'est pas valide, ne pas appliquer de filtre de kilométrage
        //             break;
        //     }
        // }
    
        $results = $queryBuilder->getQuery()->getResult();
    
        return $results;
    }

    
//    /**
//     * @return Voitures[] Returns an array of Voitures objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Voitures
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
