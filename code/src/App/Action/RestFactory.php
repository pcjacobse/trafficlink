<?php

namespace App\Action;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

class RestFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $entityManager = ($container->has(EntityManager::class))
            ? $container->get(EntityManager::class)
            : null;

        return new RestAction($entityManager);
    }
}
