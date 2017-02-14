<?php

namespace DB;

use DB\Settings;

/**
 * текущее подключение к базе
 *
 * @author Alexander
 */
abstract class Connection
{

    /**
     * настройки подключения
     * @var Settings
     */
    protected $_settings = null;
    
    /**
     *
     * @var \PDO 
     */
    protected $_connection = null;

    public function __construct(Settings $settings = null)
    {
        $this->settings = $settings;
    }

    /**
     * устанавливаем соединение с базой
     */
    protected abstract function makeConnection();

    /**
     * закрываем соединение
     */
    protected abstract function closeConnection();

    public function getConnection()
    {
        if (!$this->_connection) {
            $this->makeConnection();
        }

        return $this->_connection;
    }

    public function __destruct()
    {
        if ($this->_connection) {
            $this->closeConnection();
        }
    }

}
