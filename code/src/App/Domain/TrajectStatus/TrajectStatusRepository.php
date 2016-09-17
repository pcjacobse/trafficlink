<?php

namespace App\Domain\TrajectStatus;

use Doctrine\ORM\EntityRepository;

class TrajectStatusRepository extends EntityRepository
{
    /**
     * Get all trajects statuses sorted by measure time descending
     *
     * @return TrajectStatus[]
     */
    public function findAll()
    {
        return $this->find([], ['measuredAt' => 'DESC']);
    }
}
