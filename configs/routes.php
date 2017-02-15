<?php

return array(
//    'default' => array(
//        'path' => '/',
//        'controller' => '\Base\Controller\BaseController',
//        'action' => 'defaultAction'
//    ),
    'profile' => array(
        'name' => 'profile',
        'path' => '/profile',
        'controller' => '\Notepad\Controller\NotesController',
        'action' => 'profile',
        'auth' => 'auth'
    ),
    'addNote' => array(
        'name' => 'addNote',
        'path' => '/addNote',
        'controller' => '\Notepad\Controller\NotesController',
        'action' => 'addNote',
        'auth' => 'auth'
    ),
    'editNote' => array(
        'name' => 'editNote',
        'path' => '/editNote',
        'controller' => '\Notepad\Controller\NotesController',
        'action' => 'editNote',
        'auth' => 'auth'
    ),
    'removeNote' => array(
        'name' => 'removeNote',
        'path' => '/removeNote',
        'controller' => '\Notepad\Controller\NotesController',
        'action' => 'removeNote',
        'auth' => 'auth'
    ),
    'login' => array(
        'name' => 'login',
        'path' => '/login',
        'controller' => '\Notepad\Controller\AuthController',
        'action' => 'auth',
        'auth' => 'anon'
    ),
    'registration' => array(
        'name' => 'registration',
        'path' => '/registration',
        'controller' => '\Notepad\Controller\AuthController',
        'action' => 'registration',
        'auth' => 'anon'
    ),
    'logout' => array(
        'name' => 'logout',
        'path' => '/logout',
        'controller' => '\Notepad\Controller\AuthController',
        'action' => 'logout',
        'auth' => 'anon'
    ),
);
