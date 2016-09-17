<?php

namespace App\Patomic\Validator;

use App\Patomic\Exception\PatomicConfigException;

/**
 * Class PatomicConfigValidator
 * @package App\Patomic\Validator
 */
class PatomicConfigValidator
{
    /**
     * @var array
     */
    protected $configArray;


    /**
     * PatomicConfigValidator constructor.
     * @param $configArray
     */
    public function __construct($configArray)
    {
        $this->configArray = $configArray;
    }

    /**
     * @return bool
     * @throws PatomicConfigException
     */
    public function validate()
    {
        if ($this->hasHost() && $this->hasPort() && $this->hasStorage() && $this->hasAlias() && $this->hasDatabase()) {
            return true;
        } else {
            throw new PatomicConfigException("Missing data in configuration");
        }
    }

    /**
     * @return bool
     * @throws PatomicConfigException
     */
    public function hasHost()
    {
        if (isset($this->configArray['host'])) {
            return true;
        } else {
            throw new PatomicConfigException("Patomic host is missing from config");
        }
    }

    /**
     * @return bool
     * @throws PatomicConfigException
     */
    public function hasPort()
    {
        if (isset($this->configArray['port'])) {
            return true;
        } else {
            throw new PatomicConfigException("Patomic port is missing from config");
        }
    }

    /**
     * @return bool
     * @throws PatomicConfigException
     */
    public function hasStorage()
    {
        if (isset($this->configArray['storage'])) {
            return true;
        } else {
            throw new PatomicConfigException("Patomic storage is missing from config");
        }
    }

    /**
     * @return bool
     * @throws PatomicConfigException
     */
    public function hasAlias()
    {
        if (isset($this->configArray['alias'])) {
            return true;
        } else {
            throw new PatomicConfigException("Patomic alias is missing from config");
        }
    }

    /**
     * @return bool
     * @throws PatomicConfigException
     */
    public function hasDatabase()
    {
        if (isset($this->configArray['database'])) {
            return true;
        } else {
            throw new PatomicConfigException("Patomic database is missing from config");
        }
    }
}