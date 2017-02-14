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
                . $settings->values['dbname'], $settings->values['user'], $settings->values['password']);
    }

    protected function closeConnection()
    {
        $this->_connection = null;
    }

}
