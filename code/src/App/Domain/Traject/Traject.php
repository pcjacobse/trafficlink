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

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param int $length
     *
     * @return self
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return \App\Domain\TrajectStatus\TrajectStatus[]
     */
    public function getStatuses()
    {
        return $this->statuses;
    }

    /**
     * @param \App\Domain\TrajectStatus\TrajectStatus[] $statuses
     *
     * @return self
     */
    public function setStatuses($statuses)
    {
        $this->statuses = $statuses;

        return $this;
    }

    /**
     * @return \App\Domain\TrajectGeometryPoint\TrajectGeometryPoint[]
     */
    public function getGeometryPoints()
    {
        return $this->geometryPoints;
    }
}
