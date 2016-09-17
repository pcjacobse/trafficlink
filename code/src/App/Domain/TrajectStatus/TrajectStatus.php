<?php

namespace App\Domain\TrajectStatus;
use App\Domain\Traject\Traject;


/**
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="App\Domain\TrajectStatus\TrajectStatusRepository")
 * @\Doctrine\ORM\Mapping\Table(indexes={@\Doctrine\ORM\Mapping\Index(name="measured_at_idx", columns={"measured_at"})})
 */
class TrajectStatus
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
     * @\Doctrine\ORM\Mapping\ManyToOne(targetEntity="App\Domain\Traject\Traject", inversedBy="statuses")
     */
    protected $traject;

    /**
     * @var integer
     *
     * @\Doctrine\ORM\Mapping\Column(type="integer")
     */
    protected $velocity;

    /**
     * @var integer
     *
     * @\Doctrine\ORM\Mapping\Column(type="integer")
     */
    protected $traveltime;

    /**
     * @var \DateTime
     *
     * @\Doctrine\ORM\Mapping\Column(type="datetime")
     */
    protected $measuredAt;
}
