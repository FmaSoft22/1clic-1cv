<?php

namespace App\Repository;

use App\Entity\EmploymentTypeList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmploymentTypeList>
 *
 * @method EmploymentTypeList|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmploymentTypeList|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmploymentTypeList[]    findAll()
 * @method EmploymentTypeList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmploymentTypeListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmploymentTypeList::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(EmploymentTypeList $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(EmploymentTypeList $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return EmploymentTypeList[] Returns an array of EmploymentTypeList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EmploymentTypeList
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
