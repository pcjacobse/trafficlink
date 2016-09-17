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
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     *
     * @return self
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     *
     * @return self
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     *
     * @return self
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Populate latitude and longitude based on RD Coordinates
     *
     * @param array $coordinate
     *
     * @return self
     */
    public function setFromCoordinate($coordinate)
    {
        $wgs = self::fromRdToWgs($coordinate);

        $this->setLatitude($wgs[0]);
        $this->setLongitude($wgs[1]);

        return $this;
    }

    /**
     * Convert RD Coordinates to WGS84
     * @link http://thomasv.nl/2014/03/rd-naar-gps/
     *
     * @param $coordinate
     *
     * @return array
     */
    protected static function fromRdToWgs($coordinate)
    {
        $x0   = 155000;
        $y0   = 463000;
        $phi0 = 52.15517440;
        $lam0 = 5.38720621;

        $kp  = [0, 2, 0, 2, 0, 2, 1, 4, 2, 4, 1];
        $kq  = [1, 0, 2, 1, 3, 2, 0, 0, 3, 1, 1];
        $kpq = [3235.65389, -32.58297, -0.24750, -0.84978, -0.06550, -0.01709, -0.00738, 0.00530, -0.00039, 0.00033, -0.00012];

        $lp  = [1, 1, 1, 3, 1, 3, 0, 3, 1, 0, 2, 5];
        $lq  = [0, 1, 2, 0, 3, 1, 1, 2, 4, 2, 0, 0];
        $lpq = [5260.52916, 105.94684, 2.45656, -0.81885, 0.05594, -0.05607, 0.01199, -0.00256, 0.00128, 0.00022, -0.00022, 0.00026];

        $dX = 1E-5 * ($coordinate[0] - $x0);
        $dY = 1E-5 * ($coordinate[1] - $y0);

        $phi = 0;
        $lam = 0;

        foreach($kpq as $index => $k) {
            $phi += $k * $dX**$kp[$index] * $dY**$kq[$index];
        }

        foreach($lpq as $index => $l) {
            $lam += $l * $dX**$lp[$index] * $dY**$lq[$index];
        }
        $phi = $phi0 + $phi / 3600;
        $lam = $lam0 + $lam / 3600;

        return [$phi, $lam];
    }
}
