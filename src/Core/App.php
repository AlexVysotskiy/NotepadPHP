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

        /* @var $request Request */
        $request = $container->getService('request');

        /* @var $router Router */
        $router = $container->getService('router');

        /* @var $session Request\Session */
        $session = $container->getService('session');

        $routeInfo = $router->getRouteByPath($request->getUri());

        if (isset($routeInfo['needAuth']) && $routeInfo['needAuth'] && !$session->isAuth()) {

            // аноним хочет зайти, редиректим
            $redirectUrl = $router->generateUrl($container->getParameter('anon.route_redirect'));
            $response = new Http\Response\Redirect($redirectUrl);
        } else {

            $controller = $routeInfo['controller'];
            $action = $routeInfo['action'];

            $controller = new $controller($container);
            $response = $controller->$action($request);
        }

        $response->send();
        $request->session->close();
    }

}
