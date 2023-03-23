<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Entity\Produits;
use App\Data\ProductSearch;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Produits>
 *
 * @method Produits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produits[]    findAll()
 * @method Produits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Produits::class);
        $this->paginator = $paginator;
    }

    public function save(Produits $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Produits $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Produits[] Returns an array of Produits objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Produits
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findSearch(ProductSearch $search): PaginationInterface{
        $query = $this
        ->createQueryBuilder('p')
        ->select('c','p')
        ->join('p.marque', 'c');

        if (!empty($search->q)){
            $query = $query->andWhere('p.nom LIKE :q')
            ->setParameter('q', "%{$search->q}%");
        }

        if (!empty($search->marque)){
            $query = $query->andWhere('c.id IN (:marque)')
            ->setParameter('marque',$search->marque);
        }

        if (!empty($search->prixmin)){
            $query = $query
            ->andWhere('p.prix >= :prixmin')
            ->setParameter('prixmin',$search->prixmin);
        }

        if (!empty($search->prixmax)){
            $query = $query
            ->andWhere('p.prix <= :prixmax')
            ->setParameter('prixmax',$search->prixmax);
        }

        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query, $search->page, 9
        );
    }

}
