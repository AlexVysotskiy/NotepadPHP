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
     * @var Request
     */
    protected $_request = null;

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

    public function getRouteByPath($path)
    {
        if (!$this->_routeMap) {
            $this->readConfig();
        }

        foreach ($this->_routeMap as $name => $routeInfo) {

            if ($routeInfo['path'] == $path) {
                return $routeInfo;
            }
        }

        if (isset($this->_routeMap[$this->_defaultRoute])) {

            return $this->_routeMap[$this->_defaultRoute];
        } else {
            throw new \Exception('Route %s is not defined!', $path);
        }
    }

    public function getRouteInfo($route)
    {
        return isset($this->_routeMap[$route]) ? $this->_routeMap[$route] : null;
    }

    public function generateUrl($route, $params = array(), $absolute = false)
    {
        if (isset($this->_routeMap[$route])) {

            $routeInfo = $this->_routeMap[$route];

            $url = $routeInfo['path'];

            if ($params) {
                $url .= '?' . http_build_query($params);
            }

            if ($absolute) {

                $prefix = 'http' . ($this->_request->get('HTTPS') ? 's' : '' )
                        . '://' . $this->_request->get('SERVER_NAME');

                $url = $prefix . $url;
            }

            return $url;
        } else {
            throw new \Exception(sprintf('Unknown %s route!', $route));
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

    public function setRequest($request)
    {
        $this->_request = $request;
    }

}
