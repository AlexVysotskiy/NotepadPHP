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
                'class' => '',
                'table' => ''
            ),
            'note' => array(
                'class' => '',
                'table' => '',
            )
        )
    ),
    'anon.route_redirect' => 'default'
);
