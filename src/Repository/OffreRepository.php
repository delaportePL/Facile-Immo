<?php

namespace App\Repository;

use App\Entity\Offre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Offre>
 *
 * @method Offre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offre[]    findAll()
 * @method Offre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offre::class);
    }

    public function add(Offre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Offre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAll()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT * FROM offre';
        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery();

        return $result->fetchAllAssociative();
    }


    public function findLikedOffresByUserIdAndType(int $userId, int $type)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT * FROM offre o
            JOIN liked_offre lo ON lo.offre_id = o.id
            WHERE lo.user_id = :userId
            AND lo.type = :type';

        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery(['userId' => $userId, 'type' => $type]);
        return $result->fetchAllAssociative();
    }


    public function findAllOffersByUserId(int $userId)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT o.*, lo.user_id, lo.type as liked_offre_type FROM offre o 
            LEFT JOIN liked_offre lo ON lo.offre_id = o.id
            WHERE lo.user_id = :userId OR lo.user_id IS NULL';

        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery(['userId' => $userId]);
        return $result->fetchAllAssociative();
    }
}
