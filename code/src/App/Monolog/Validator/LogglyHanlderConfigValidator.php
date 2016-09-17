<?php

namespace App\Monolog\Validator;

use App\Monolog\Exception\MonologConfigException;

/**
 * Class LogglyHanlderConfigValidator
 * @package App\Monolog\Validator
 */
class LogglyHanlderConfigValidator extends AbstractHandlerConfigValidator
{

    /**
     * @return bool
     * @throws MonologConfigException
     */
    public function validate()
    {
        if (parent::hasLevel() && $this->hasToken()) {
            return true;
        }
    }


    /**
     * @return bool
     * @throws MonologConfigException
     */
    public function hasToken()
    {
        if (isset($this->handlerConfigArray['token'])) {
            return true;
        } else {
            throw new MonologConfigException("Missing token in Loggly config");
        }
    }
}