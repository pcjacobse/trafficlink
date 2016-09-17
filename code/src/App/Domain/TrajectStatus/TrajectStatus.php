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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Traject
     */
    public function getTraject()
    {
        return $this->traject;
    }

    /**
     * @param Traject $traject
     *
     * @return self
     */
    public function setTraject($traject)
    {
        $this->traject = $traject;

        return $this;
    }

    /**
     * @return int
     */
    public function getVelocity()
    {
        return $this->velocity;
    }

    /**
     * @param int $velocity
     *
     * @return self
     */
    public function setVelocity($velocity)
    {
        $this->velocity = $velocity;

        return $this;
    }

    /**
     * @return int
     */
    public function getTraveltime()
    {
        return $this->traveltime;
    }

    /**
     * @param int $traveltime
     *
     * @return self
     */
    public function setTraveltime($traveltime)
    {
        $this->traveltime = $traveltime;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getMeasuredAt()
    {
        return $this->measuredAt;
    }

    /**
     * @param \DateTime $measuredAt
     *
     * @return self
     */
    public function setMeasuredAt($measuredAt)
    {
        $this->measuredAt = $measuredAt;

        return $this;
    }
}
