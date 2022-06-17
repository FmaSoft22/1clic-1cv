<?php

namespace App\Repository;

use App\Entity\Candidateexperiences;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Candidateexperiences>
 *
 * @method Candidateexperiences|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidateexperiences|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidateexperiences[]    findAll()
 * @method Candidateexperiences[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidateexperiencesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Candidateexperiences::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Candidateexperiences $entity, bool $flush = true): void
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
    public function remove(Candidateexperiences $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Candidateexperiences[] Returns an array of Candidateexperiences objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Candidateexperiences
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
