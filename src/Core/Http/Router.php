<?php

namespace Core\Http;

/**
 * Description of Router
 *
 * @author Alexander
 */
class Router
{

    /**
     *
     * @var type 
     */
    protected $_configType = null;

    /**
     *
     * @var type 
     */
    protected $_defaultRoute = null;
    protected $_routeMap = array();

    public function getController($path)
    {
        if (!$this->_routeMap) {
            $this->readConfig();
        }

        if (isset($this->_routeMap[$path])) {

            return $this->_routeMap[$path];
        } elseif (isset($this->_routeMap[$this->_defaultRoute])) {

            return $this->_routeMap[$this->_defaultRoute];
        } else {
            throw new \Exception('Route %s is not defined!', $path);
        }
    }

    protected function readConfig()
    {
        /* @var $reader \Core\ConfigReader */
        $reader = \Core\ConfigReader\Factory::getReader($this->_configType, array('type' => 'routes'));
        $this->_routeMap = $reader->read();
    }

    public function setConfigType($type)
    {
        $this->_configType = $type;
    }

    public function setDefaultRoute($default)
    {
        $this->_defaultRoute = $default;
    }

}
