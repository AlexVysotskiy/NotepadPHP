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

    public function __construct(Container $container)
    {
        $this->_container = $container;
    }

    protected function render($view, $data = array())
    {
        $content = $this->get('template_renderer')->render($view, $data);

        return new Response($content);
    }

    protected function get($service)
    {
        return $this->_container->getService($service);
    }

    protected function getParam($param)
    {
        return $this->_container->getParameter($param);
    }

}
