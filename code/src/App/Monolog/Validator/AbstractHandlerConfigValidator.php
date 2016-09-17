<?php


namespace App\Monolog\Validator;


use App\Monolog\Exception\MonologConfigException;

/**
 * Class AbstractHandlerConfigValidator
 * @package App\Monolog\Validator
 */
class AbstractHandlerConfigValidator
{
    /**
     * @var array
     */
    protected $handlerConfigArray;


    /**
     * AbstractHandlerConfigValidator constructor.
     * @param $handlerConfigArray
     */
    public function __construct($handlerConfigArray)
    {
        $this->handlerConfigArray = $handlerConfigArray;
    }

    /**
     * @return bool
     * @throws MonologConfigException
     */
    public function validate()
    {
        if ($this->hasLevel()) {
            return true;
        } else {
            throw new MonologConfigException("Missing data in handler configuration");
        }
    }

    /**
     * @return bool
     * @throws MonologConfigException
     */
    public function hasLevel()
    {
        if (isset($this->handlerConfigArray['level'])) {
            return true;
        } else {
            throw new MonologConfigException("Monolog level is missing from config");
        }
    }
}