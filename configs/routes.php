<?php

return array(
    'default' => array(
        'path' => '/',
        'controller' => '\Base\Controller\BaseController',
        'action' => 'defaultAction'
    ),
    'profile' => array(
        'path' => '/profile',
        'controller' => '\Base\Controller\BaseController',
        'action' => 'profile',
        'needAuth' => true
    ),
);
