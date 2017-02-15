<?php

return array(
    'router' => array(
        'class' => '\Core\Http\Router',
        'calls' => array(
            'setConfigType' => array('php'),
            'setDefaultRoute' => array('login'),
            'setRequest' => array('@request'),
        )
    ),
    'request' => array(
        'class' => '\Core\Http\Request',
        'calls' => array(
            'setSession' => array('@session'),
            'setCookie' => array('@cookie'),
        )
    ),
    'session' => array(
        'class' => '\Core\Http\Request\Session',
    ),
    'cookie' => array(
        'class' => '\Core\Http\Request\Cookie'
    ),
    'template_renderer' => array(
        'class' => '\Core\Http\Renderer'
    ),
    'db.connector' => array(
        'class' => '\DB\EntityManager',
        'calls' => array(
            'setDriver' => array('@db.driver.mysql'),
        )
    ),
    'db.driver.mysql' => array(
        'class' => '\DB\Driver\MySQLDriver',
        'calls' => array(
            'setConnectionSettings' => array('%db:connection'),
            'setEntitySettings' => array('%db'),
        )
    ),
    'users_kit' => array(
        'class' => '\Notepad\Kit\UsersKit',
        'calls' => array(
            'setEntityManager' => array('@db.connector'),
            'setAuthSettings' => array('%auth'),
            'setSession' => array('@session')
        )
    ),
    'notes_kit' => array(
        'class' => '\Notepad\Kit\NotesList',
        'calls' => array(
            'setEntityManager' => array('@db.connector'),
        )
    )
);
