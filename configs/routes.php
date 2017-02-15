<?php

return array(
    'install' => array(
        'path' => '/installAPP',
        'controller' => '\Core\Http\Controller\BaseController',
        'action' => 'install'
    ),
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
//        'auth' => 'anon'
    ),
    'apiRegistration' => array(
        'name' => 'apiRegistration',
        'path' => '/api/registration',
        'controller' => '\API\Controller\AuthController',
        'action' => 'registration'
    ),
    'apiAuth' => array(
        'name' => 'apiAuth',
        'path' => '/api/auth',
        'controller' => '\API\Controller\AuthController',
        'action' => 'auth'
    ),
    'apiUser' => array(
        'name' => 'apiUser',
        'path' => '/api/user',
        'controller' => '\API\Controller\AuthController',
        'action' => 'user'
    ),
    'apiNote' => array(
        'name' => 'apiNote',
        'path' => '/api/note',
        'controller' => '\API\Controller\NotesController',
        'action' => 'note'
    ),
    'apiNotesList' => array(
        'name' => 'apiNotesList',
        'path' => '/api/notes',
        'controller' => '\API\Controller\NotesController',
        'action' => 'notesList'
    ),
    'apiNoteAdd' => array(
        'name' => 'apiNoteAdd',
        'path' => '/api/note/add',
        'controller' => '\API\Controller\NotesController',
        'action' => 'addNote'
    ),
    'apiNoteEdit' => array(
        'name' => 'apiNoteEdit',
        'path' => '/api/note/edit',
        'controller' => '\API\Controller\NotesController',
        'action' => 'editNote'
    ),
    'removeNote' => array(
        'name' => 'removeNote',
        'path' => '/api/note/remove',
        'controller' => '\API\Controller\NotesController',
        'action' => 'removeNote'
    ),
);
