<?php

$root = realpath(__DIR__ . '/..');
define('ROOT_PATH', $root);

spl_autoload_register(function ($class_name)
{
    $path = ROOT_PATH . '/src/' . $class_name . '.php';

    if (!file_exists($path)) {
        return;
    }
    include $path;
});


return \Core\App::run();
