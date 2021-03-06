<?php

namespace CarBundle\Repository;

/**
 * CarRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CarRepository extends \Doctrine\ORM\EntityRepository
{
    public function findCarsWithDetails()
    {
        $qb = $this->createQueryBuilder('c');
        $qb->select('c, co, m');
        $qb->join('c.company', 'co');
        $qb->join('c.model', 'm');

        return $qb->getQuery()->getResult();
    }

    public function findCarWithDetails(int $id)
    {
        $qb = $this->createQueryBuilder('c');
        $qb->select('c, co, m');
        $qb->join('c.company', 'co');
        $qb->join('c.model', 'm');
        $qb->where('c.id = :id');
        $qb->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }
}
