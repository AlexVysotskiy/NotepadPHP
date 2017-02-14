<?php

namespace Core;

/**
 * Description of Router
 *
 * @author Alexander
 */
class Router
{

    protected $_routeMap = array();
    protected $_default = null;

    public function __construct()
    {
        $this->_readConfig();
        $this->_default = '/';
    }

    public function getController($path)
    {
        if (isset($this->_routeMap[$path])) {

            return $this->_routeMap[$path];
        } else {

            return $this->_routeMap[$this->_default];
//            throw new \Exception("Route " . $path . " is not defined");
        }
    }

    protected function _readConfig()
    {
        $this->_routeMap = array(
            '/' => array(
                'controller' => 'Controllers\\MainController',
                'action' => 'main'
            ),
            '/ping' => array(
                'controller' => 'Controllers\\MainController',
                'action' => 'ping'
            ),
        );
    }

}
