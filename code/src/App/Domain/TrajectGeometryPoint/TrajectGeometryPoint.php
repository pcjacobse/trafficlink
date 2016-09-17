<?php

namespace App\Domain\TrajectGeometryPoint;
use App\Domain\Traject\Traject;


/**
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="App\Domain\TrajectGeometry\TrajectGeometryRepository")
 * @\Doctrine\ORM\Mapping\Table(indexes={@\Doctrine\ORM\Mapping\Index(name="position_idx", columns={"position"})})
 */
class TrajectGeometryPoint
{
    /**
     * @var integer
     *
     * @\Doctrine\ORM\Mapping\Id
     * @\Doctrine\ORM\Mapping\GeneratedValue
     * @\Doctrine\ORM\Mapping\Column(type="integer")
     */
    protected $id;

    /**
     * @var Traject
     *
     * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="App\Domain\Traject\Traject", inversedBy="geometryPoints")
     */
    protected $traject;

    /**
     * @var integer
     *
     * @\Doctrine\ORM\Mapping\Column(type="integer")
     */
    protected $position;

    /**
     * @var float
     *
     * @\Doctrine\ORM\Mapping\Column(type="decimal", nullable=true, scale=8, precision=11)
     */
    protected $latitude;

    /**
     * @var float
     *
     * @\Doctrine\ORM\Mapping\Column(type="decimal", nullable=true, scale=8, precision=11)
     */
    protected $longitude;
}
