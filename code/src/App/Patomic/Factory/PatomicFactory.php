<?php

namespace App\Patomic\Factory;

use App\Patomic\Exception\PatomicConfigException;
use App\Patomic\Validator\PatomicConfigValidator;
use Interop\Container\ContainerInterface;
use taywils\Patomic\Patomic;

/**
* Class App\PatomicFactory
* @package App\Patomic
*/
class PatomicFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     * @return Patomic
     * @throws PatomicConfigException
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        $config = $serviceContainer->get('config');
        if (null === $config) {
            throw new PatomicConfigException("Can not find patomic configuration in your config. Make sure to have patomic configuration array in your config");
        }
        
        $validator = new PatomicConfigValidator($config['patomic']);
        $validator->validate();

        ob_start();
        $patomic = new Patomic($config['patomic']['host'], $config['patomic']['port'], $config['patomic']['storage'], $config['patomic']['alias']);
        $patomic->createDatabase($config['patomic']['database']);
        $patomic->setDatabase($config['patomic']['database']);
        ob_end_clean();

        return $patomic;
    }
}