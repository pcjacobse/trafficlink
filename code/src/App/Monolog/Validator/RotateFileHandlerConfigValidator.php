<?php


namespace App\Monolog\Validator;


use App\Monolog\Exception\MonologConfigException;


/**
 * Class RotateFileHandlerConfigValidator
 * @package App\Monolog\Validator
 */
class RotateFileHandlerConfigValidator extends AbstractHandlerConfigValidator
{

    /**
     * @return bool
     * @throws MonologConfigException
     */
    public function validate()
    {
        if (parent::hasLevel() && $this->hasFilename()) {
            return true;
        }
    }

    /**
     * @return bool
     */
    public function hasFilename()
    {
        if (isset($this->handlerConfigArray['filename'])) {
            return true;
        } else {
            throw new MonologConfigException("Missing filename in Rotate File handler configuration");
        }
    }


}