<?php

namespace Core\Http\Controller;

use Core\Http\Response;
use Core\Container;

abstract class AbstractController
{

    /**
     *
     * @var Container 
     */
    protected $_container = null;
    
    /**
     *
     * @var type 
     */
    protected $_routeInfo = null;

    /**
     *
     * @var type 
     */
    protected $_assigned = array();

    public function __construct(Container $container)
    {
        $this->_container = $container;
    }

    protected function render($view, $data = array())
    {
        $data['router'] = $this->get('router');
        $data['routeInfo'] = $this->_routeInfo;

        $content = $this->get('template_renderer')->render($view, array_merge($data, $this->_assigned));

        return new Response($content);
    }

    protected function redirectByRoute($routeName, $params = array())
    {
        $url = $this->get('router')->generateUrl($routeName, $params);

        return new Response\Redirect($url);
    }

    protected function get($service)
    {
        return $this->_container->getService($service);
    }

    protected function getParam($param)
    {
        return $this->_container->getParameter($param);
    }

    protected function assign($key, $value)
    {
        $this->_assigned[$key] = $value;
    }

    /**
     * @return \Core\Http\Request\Session
     */
    protected function getSession()
    {
        return $this->get('session');
    }

    public function setRouteInfo($info)
    {
        $this->_routeInfo = $info;
    }
}
