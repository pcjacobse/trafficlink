<?php


namespace App\Monolog\Validator;


use App\Monolog\Exception\MonologConfigException;

/**
 * Class StreamHandlerConfigValidator
 * @package App\Monolog\Validator
 */
class StreamHandlerConfigValidator extends AbstractHandlerConfigValidator
{

    /**
     * @return bool
     * @throws MonologConfigException
     */
    public function validate()
    {
        if (parent::hasLevel() && $this->hasPath()) {
            return true;
        }
    }


    /**
     * @return bool
     */
    public function hasPath()
    {
        if (isset($this->handlerConfigArray['path'])) {
            return true;
        } else {
            throw new MonologConfigException("Missing Path in Stream handler configuration");
        }
    }


}