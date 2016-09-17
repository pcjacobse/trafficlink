<?php

namespace App\Entity;

use taywils\Patomic\PatomicEntity;
use taywils\Patomic\PatomicTransaction;

class Traject
{
    use PatomicEntityTrait;

    protected static $containerName = 'traject';

    /**
     * @PatomicEntity
     *
     * @var string
     */
    protected $name;

    /**
     * @PatomicEntity
     *
     * @var int
     */
    protected $velocity;

    /**
     * @PatomicEntity
     *
     * @var int
     */
    protected $length;

    /**
     * @PatomicEntity
     *
     * @var int
     */
    protected $travelTime;

    protected $geometryPoints;

    public static function setup()
    {
        $name = new PatomicEntity();
        $name
            ->ident(self::$containerName, 'name')
            ->valueType('string')
            ->cardinality('one')
            ->doc('Name of the traject')
            ->install('attribute');
        
        $velocity = new PatomicEntity();
        $velocity
            ->ident(self::$containerName, 'velocity')
            ->valueType('bigint')
            ->cardinality('one')
            ->doc('Average velocity of vehicles on the traject in kmph')
            ->install('attribute');
        
        $length = new PatomicEntity();
        $length
            ->ident(self::$containerName, 'length')
            ->valueType('bigint')
            ->cardinality('one')
            ->doc('Length of the traject in meters')
            ->install('attribute');

        $travelTime = new PatomicEntity();
        $travelTime
            ->ident(self::$containerName, 'travelTime')
            ->valueType('bigint')
            ->cardinality('one')
            ->doc('Average time it takes a vehicle to pass the traject in seconds')
            ->install('attribute');

        $pt = new PatomicTransaction();
        $pt->append($name)
            ->append($velocity)
            ->append($length)
            ->append($travelTime);

        return $pt;
    }
}