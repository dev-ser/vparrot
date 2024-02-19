<?php

namespace App\Repository;

use App\Entity\Avis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Avis>
 *
 * @method Avis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Avis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Avis[]    findAll()
 * @method Avis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Avis::class);
    }

    /**
     * Méthode pour récupérer tous les avis avec une note spécifique.
     *
     * @param int $note
     * @return Avis[]
     */
    public function findByNote(int $note): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.note = :note')
            ->setParameter('note', $note)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Méthode pour récupérer tous les avis validés.
     *
     * @return Avis[]
     */
    public function findValides(): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.valide = true')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getResult();
    }


}
