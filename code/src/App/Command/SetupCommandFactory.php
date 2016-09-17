<?php // src/App/Command/GreetCommandFactory.php

namespace App\Command;

use Interop\Container\ContainerInterface;
use Monolog\Logger;

class SetupCommandFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new SetupCommand(
            $container->get(Logger::class)
        );
    }
}