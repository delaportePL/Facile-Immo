<?php

namespace App\Repository;

use App\Data\SearchData;
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
    public function __construct(
        ManagerRegistry $registry)
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
        $qb = $this->createQueryBuilder('o');

        return $qb->getQuery()->getResult();
    }


    public function getQueryWithSearch(SearchData $search, array $dislikedOfferIds)
    {
        $qb = $this->createQueryBuilder('o');
        $qb 
            ->join('o.localisation', 'loc')
            ->groupBy('o.id');

        //Si le tableau d'id d'offres masquées n'est pas vide, le queryBuilder ne sélectionnera pas les offres correpsondants à ces id
        if(!empty($dislikedOfferIds)){
            $qb = $qb
                ->andWhere($qb->expr()->notIn('o.id', $dislikedOfferIds));
        }

        if(!empty($search->localisation)){
            $qb = $qb
                ->andWhere('o.localisation = :localisation')
                ->setParameter('localisation', $search->localisation);
        }

        if(!empty($search->superficieMin)){
            $qb = $qb
                ->andWhere('o.superficie >= :superficieMin')
                ->setParameter('superficieMin', $search->superficieMin);
        }
        if(!empty($search->superficieMax)){
            $qb = $qb
                ->andWhere('o.superficie <= :superficieMax')
                ->setParameter('superficieMax', $search->superficieMax);
        }

        if(!empty($search->prixMin)){
            $qb = $qb
                ->andWhere('o.prix >= :prixMin')
                ->setParameter('prixMin', $search->prixMin);
        }
        if(!empty($search->prixMax)){
            $qb = $qb
                ->andWhere('o.prix <= :prixMax')
                ->setParameter('prixMax', $search->prixMax);
        }

        if(!empty($search->type)){
            $qb = $qb
                ->andWhere('o.type IN (:type)')
                ->setParameter('type',$search->type);
        }

        return $qb;
    }
}
