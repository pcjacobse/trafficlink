<?php

namespace App\Domain\Traject;
use App\Domain\TrajectGeometryPoint\TrajectGeometryPoint;
use App\Domain\TrajectStatus\TrajectStatus;


/**
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="App\Domain\Traject\TrajectRepository")
 * @\Doctrine\ORM\Mapping\Table()
 */
class Traject
{
    /**
     * @var string
     *
     * @\Doctrine\ORM\Mapping\Id
     * @\Doctrine\ORM\Mapping\Column(type="string", length=255)
     */
    protected $id;

    /**
     * @var string
     *
     * @\Doctrine\ORM\Mapping\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @var integer
     *
     * @\Doctrine\ORM\Mapping\Column(type="integer")
     */
    protected $length;

    /**
     * @var TrajectStatus[]
     *
     * @\Doctrine\ORM\Mapping\OneToMany(targetEntity="App\Domain\TrajectStatus\TrajectStatus", mappedBy="traject")
     * @\Doctrine\ORM\Mapping\OrderBy({"measuredAt" = "DESC"})
     */
    protected $statuses;

    /**
     * @var TrajectGeometryPoint[]
     *
     * @\Doctrine\ORM\Mapping\OneToMany(targetEntity="App\Domain\TrajectGeometryPoint\TrajectGeometryPoint", mappedBy="traject")
     * @\Doctrine\ORM\Mapping\OrderBy({"position" = "ASC"})
     */
    protected $geometryPoints;
}
