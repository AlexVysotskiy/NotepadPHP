<?php

namespace DB;

/**
 * Description of EntityManager
 *
 * @author Alexander
 */
class EntityManager
{

    /**
     * @var Driver
     */
    protected $_driver = null;

    public function getConnection()
    {
        return $this->_driver->getConnection();
    }

    public function getDriver()
    {
        return $this->_driver;
    }

    public function setDriver(Driver $driver)
    {
        $this->_driver = $driver;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->getDriver(), $name), $arguments);
    }

}
