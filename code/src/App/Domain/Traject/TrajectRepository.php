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
}
