<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class DonationRepository
 * @package App\Repository
 */
class DonationRepository extends EntityRepository
{
    /**
     * @return array
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getMaxDonor()
    {
        $qb = $this->createQueryBuilder('q');

        $qb->select('q.name, SUM(q.amount) as sumAmount')
           ->groupBy('q.name')
           ->orderBy('sumAmount', 'desc')
           ->setMaxResults(1)
        ;

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * @return array
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getMonthMount()
    {
        $dataStart = new \DateTime();
        $dataEnd = new \DateTime();

        $monthStart = strtotime('first day of this month', time());
        $monthEnd = strtotime('last day of this month', time());

        $dataStart->setTimestamp($monthStart);
        $dataEnd->setTimestamp($monthEnd);

        $qb = $this->createQueryBuilder('q');

        $qb->select('SUM(q.amount) as sumAmount')
           ->where($qb->expr()->between('q.createdAt', ":start", ":end"))
           ->setParameters([
               'start' => $dataStart,
               'end' => $dataEnd
           ])
        ;

        return $qb->getQuery()->getSingleResult();
    }
}
