<?php

namespace App\Repository;

use App\Entity\OffreDislike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OffreDislike>
 *
 * @method OffreDislike|null find($id, $lockMode = null, $lockVersion = null)
 * @method OffreDislike|null findOneBy(array $criteria, array $orderBy = null)
 * @method OffreDislike[]    findAll()
 * @method OffreDislike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreDislikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OffreDislike::class);
    }

    public function add(OffreDislike $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OffreDislike $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
