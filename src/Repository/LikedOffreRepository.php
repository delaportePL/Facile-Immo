<?php

namespace App\Repository;

use App\Entity\LikedOffre;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LikedOffre>
 *
 * @method LikedOffre|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikedOffre|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikedOffre[]    findAll()
 * @method LikedOffre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikedOffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikedOffre::class);
    }

    public function add(LikedOffre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LikedOffre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


}
