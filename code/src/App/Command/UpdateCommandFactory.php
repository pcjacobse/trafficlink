<?php // src/App/Command/GreetCommandFactory.php

namespace App\Command;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Monolog\Logger;

class UpdateCommandFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new UpdateCommand(
            $container->get(Logger::class),
            $container->get(EntityManager::class)
        );
    }
}