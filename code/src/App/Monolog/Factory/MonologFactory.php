<?php
namespace App\Monolog\Factory;

use Interop\Container\ContainerInterface;
use Monolog\Logger;
use App\Monolog\Exception\MonologConfigException;
use App\Monolog\Extension\MonologConfigurationExtension;

/**
 * Class App\MonologFactory
 * @package App\Monolog\Factory
 */
class MonologFactory
{

    /**
     * @param ContainerInterface $serviceContainer
     * @return Logger
     * @throws MonologConfigException
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        $config = $serviceContainer->get('config');
        if (null === $config) {
            throw new MonologConfigException("Can not find monolog configuration in your config. Make sure to have monolog configuration array in your config");
        }

        $helper = new MonologConfigurationExtension($config['monolog']);
        $logHandlers = $helper->getLogHandlers();
        $loggerName = (isset($config['monolog']['logger_name']) ? $config['monolog']['logger_name'] : 'monolog');
        /**
         * @var Logger
         */
        $monologLogger = new Logger($loggerName);
        $monologLogger->setHandlers($logHandlers);

        return $monologLogger;
    }
}