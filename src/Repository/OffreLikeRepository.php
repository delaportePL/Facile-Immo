<?php

namespace App\Repository;

use App\Entity\OffreLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OffreLike>
 *
 * @method OffreLike|null find($id, $lockMode = null, $lockVersion = null)
 * @method OffreLike|null findOneBy(array $criteria, array $orderBy = null)
 * @method OffreLike[]    findAll()
 * @method OffreLike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OffreLike::class);
    }

    public function add(OffreLike $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OffreLike $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
