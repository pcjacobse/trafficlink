<?php

namespace App\Domain\Traject;

use Doctrine\ORM\EntityRepository;

class TrajectRepository extends EntityRepository
{
    /**
     * Get all trajects sorted by name
     *
     * @return Traject[]
     */
    public function findAll()
    {
        return $this->find([], ['name' => 'ASC']);
    }

    /**
     * Get all trajects and statuses from the last hour
     *
     * @return Traject[]
     */
    public function findAllWithStatusFromLastHour()
    {
        $time = new \DateTime();
        $time->sub(new \DateInterval('PT1H'));

        return $this->createQueryBuilder('t')
            ->innerJoin('t.statuses', 's')
            ->addSelect('s')
            ->where('s.measuredAt > :time')
            ->setParameter('time', $time)
            ->getQuery()
            ->getResult();
    }
}
