<?php

namespace App\Entity;

use taywils\Patomic\PatomicEntity;
use taywils\Patomic\PatomicTransaction;

class GeometryPoint
{
    protected $traject;

    protected $position;
    protected $latitude;
    protected $longitude;


    public static function setup()
    {
        $traject = new PatomicEntity();
        $traject
            ->ident('geometryPoint', 'traject')
            ->valueType('ref')
            ->cardinality('one')
            ->doc('Traject')
            ->install('attribute');

        $position = new PatomicEntity();
        $position
            ->ident('geometryPoint', 'position')
            ->valueType('bigint')
            ->cardinality('one')
            ->doc('Position of the geometryPoint in the traject')
            ->install('attribute');

        $latitude = new PatomicEntity();
        $latitude
            ->ident('geometryPoint', 'latitude')
            ->valueType('double')
            ->cardinality('one')
            ->doc('Latitude of the geometryPoint')
            ->install('attribute');

        $longitude = new PatomicEntity();
        $longitude
            ->ident('geometryPoint', 'longitude')
            ->valueType('double')
            ->cardinality('one')
            ->doc('Longitude of the geometryPoint')
            ->install('attribute');

        $pt = new PatomicTransaction();
        $pt->append($traject)
            ->append($position)
            ->append($latitude)
            ->append($longitude);

        return $pt;
    }
}