<?php

namespace Core;

use Core\Http\Request;
use Core\Http\Router;
use Core\Container;

class App
{

    public static function run()
    {
        /* @var $container Container */
        $container = Container::getInstance();

        $request = $container->getService('request');
        $router = $container->getService('router');

        $controllerInfo = $router->getController($request->getUri());

        $controller = $controllerInfo['controller'];
        $action = $controllerInfo['action'];

        $controller = new $controller($container);
        $response = $controller->$action($request);

        $response->send();

        $request->session->close();
    }

}
