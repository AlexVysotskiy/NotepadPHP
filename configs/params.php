<?php

return array(
    'db' => array(
        'driver' => 'mysql',
        'connection' => array(
            'user' => 'dragon_gate',
            'password' => 'dragongatepass',
            'dbname' => 'notepad_db',
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
            )
        )
    ),
    'anon.route_redirect' => 'login',
    'auth.route_redirect' => 'profile',
    'auth' => array(
        'passwod.sault' => 'adasdasdas1312312'
    )
);
