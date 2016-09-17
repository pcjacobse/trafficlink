<?php

namespace App\Entity;

use taywils\Patomic\Patomic;
use taywils\Patomic\PatomicQuery;

Trait PatomicEntityTrait
{
    public static function loadEntity($id, Patomic $patomic)
    {
        $pq = new PatomicQuery();

        $entities = self::getPatonicEntities();

        foreach($entities as $entity) {
            $pq->find($entity)
                ->where(['entity' => self::$containerName . '/' . $entity, $entity]);
        }

        var_dump($pq->getQuery());
        $patomic->commitRegularQuery($pq);

        return $patomic->getQueryResult();
    }

    protected static function getPatonicEntities()
    {
        $patonicEntities = [];

        $class = static::class;
        $reflect = new \ReflectionClass(new $class);
        $properties = $reflect->getProperties(\ReflectionProperty::IS_PROTECTED);
        foreach($properties as $property) {
            if(strpos($property->getDocComment(), '@PatomicEntity') === false) continue;

            $patonicEntities[] = $property->getName();
        }

        return $patonicEntities;
    }
}