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

        if (isset($routeInfo['auth'])) {

            if ($routeInfo['auth'] == 'auth' && !$session->isAuth()) {

                // аноним хочет зайти, редиректим
                $redirectUrl = $router->generateUrl($container->getParameter('anon.route_redirect'));
                $response = new Http\Response\Redirect($redirectUrl);
            } elseif ($routeInfo['auth'] == 'anon' && $session->isAuth()) {

                // аноним хочет зайти, редиректим
                $redirectUrl = $router->generateUrl($container->getParameter('auth.route_redirect'));
                $response = new Http\Response\Redirect($redirectUrl);
            }

            if (isset($response)) {

                $request->session->close();
                return $response->send();
                exit;
            }
        }

        $controller = $routeInfo['controller'];
        $action = $routeInfo['action'];

        $controller = new $controller($container);
        $controller->setRouteInfo($routeInfo);

        $response = $controller->$action($request);

        if (!($response instanceof Http\Response)) {
            throw new \Exception('Action must return some response!');
        }


        $request->session->close();
        $response->send();
    }

}
