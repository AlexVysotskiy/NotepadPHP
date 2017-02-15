<?php

namespace DB\Connection;

use DB\Connection;

/**
 *
 * @author Alexander
 */
class MySQLConnection extends Connection
{

    protected function makeConnection()
    {
        $settings = $this->_settings;
        $this->_connection = new \PDO('mysql:host='
                . $settings->values['host'] . ';dbname='
                . $settings->values['dbname'], $settings->values['user'], $settings->values['password'], array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ));
    }

    protected function closeConnection()
    {
        $this->_connection = null;
    }

}
