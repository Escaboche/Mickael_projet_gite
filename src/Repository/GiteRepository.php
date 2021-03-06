<?php

namespace App\Repository;

use App\Entity\Gite;
use App\Entity\GiteSearch;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


/**
 * @method Gite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gite[]    findAll()
 * @method Gite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gite::class);
    }

    /**
     * @return Gite[] Returns an array of Gite objects
     */

    public function findLastGite(): array
    {
        return $this->createQueryBuilder('g')
            ->orderBy('g.created_at', 'DESC')
            ->setMaxResults(9)
            ->getQuery()
            ->getResult();
    }

    // public function findOneBySomeField($value): ?Gite
    // {
    //     return $this->createQueryBuilder('g')
    //         ->andWhere('g.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult();
    // }

    public function findAllGiteSearch(GiteSearch $search) : array
    {
        $query = $this->createQueryBuilder('g')
            ->select('g','e')
            ->join("g.equipements", "e")
            ->join("g.services", "s");


        // ->join('g.services','s');



        if ($search->getMinSurface()) {
            $query = $query
                ->andWhere('g.surface > :minSurface')
                ->setParameter('minSurface', $search->getMinSurface())
                ->orderBy('g.surface', 'ASC');
        }

        if ($search->getMaxBedrooms()) {
            $query = $query
                ->andWhere('g.bedrooms <= :maxBedrooms')
                ->setParameter('maxBedrooms', $search->getMaxBedrooms())
                ->orderBy('g.bedrooms', 'DESC');
        }

        if ($search->getMaxPrice()) {
            $query = $query
                ->andWhere('g.price < :maxPrice')

                ->setParameter('maxPrice', $search->getMaxPrice())
                ->orderBy('g.price', 'DESC');
        }

        if ((!empty($search->getAnimalsFriendly()))) {
            $query = $query
                ->andWhere('g.animals = 1');
        }

        if ((!empty($search->getByEquipement()))) {

            foreach ($search->getByEquipement() as $equipement) {
                $query = $query
                            ->andWhere('e.id = :alpha')
                            ->setParameter("alpha", $equipement->getId());
                            // ->setParameters();
            }

            // $query = $query

            //     ->andWhere('e.id IN (:equipements)')
            //     ->setParameter('equipements', $search->getByEquipement());
        }

           if ((!empty($search->getByServices()))) 
           {

            foreach ($search->getByServices() as $services) {
                $query = $query
                            ->andWhere('s.id = :alpha')
                            ->setParameter("alpha", $services->getId());
            }
          }

        return $query->getQuery()->getResult();
    }


    
    public function findByName(GiteSearch $search) : array
    {
        $query = $this->createQueryBuilder('g')
                        ->select('g');

    if (!empty($search->getSearchGite())) {
        $query = $query
                    ->andWhere('g.name LIKE :word ')
                    ->setParameter('word' , "%{$search->getSearchGite()}%");
    }

    return $query->getQuery()->getResult();
    }
    /*
    public function findOneBySomeField($value): ?Gite
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
