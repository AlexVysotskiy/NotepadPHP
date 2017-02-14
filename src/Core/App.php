<?php

namespace Core;

use Core\Request;
use Core\Router;

class App
{

    public static function run()
    {
        $request = new Request();
        $router = new Router();

        $controllerInfo = $router->getController($request->getUri());

        $controller = $controllerInfo['controller'];
        $action = $controllerInfo['action'];

        $controller = new $controller();
        $response = $controller->$action($request);

        $response->send();

        $request->session->close();
    }

}
