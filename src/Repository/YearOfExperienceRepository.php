<?php

namespace App\Repository;

use App\Entity\YearOfExperience;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<YearOfExperience>
 *
 * @method YearOfExperience|null find($id, $lockMode = null, $lockVersion = null)
 * @method YearOfExperience|null findOneBy(array $criteria, array $orderBy = null)
 * @method YearOfExperience[]    findAll()
 * @method YearOfExperience[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YearOfExperienceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, YearOfExperience::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(YearOfExperience $entity, bool $flush = true): void
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
    public function remove(YearOfExperience $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return YearOfExperience[] Returns an array of YearOfExperience objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('y.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?YearOfExperience
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
