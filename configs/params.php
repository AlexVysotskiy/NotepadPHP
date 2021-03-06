<?php

return array(
    'db' => array(
        'driver' => 'mysql',
        'connection' => array(
            'user' => null,
            'password' => null,
            'dbname' => null,
            'host' => 'localhost',
        ),
        'entities' => array(
            'user' => array(
                'class' => '\Notepad\Entity\User',
                'table' => 'users'
            ),
            'note' => array(
                'class' => '\Notepad\Entity\Note',
                'table' => 'note',
            ),
            'apiAuth' => array(
                'class' => '\API\Entity\Auth',
                'table' => 'api_auth',
            ),
        )
    ),
    'anon.route_redirect' => 'login',
    'auth.route_redirect' => 'profile',
    'auth' => array(
        'passwod.sault' => 'adasdasdas1312312'
    )
);
