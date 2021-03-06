<?php

namespace Core\Http\Request;

class Session
{

    protected $_params = array();

    public function __construct()
    {
        session_start();

        if (isset($_SESSION['app_params'])) {
            $this->_params = json_decode($_SESSION['app_params'], true);
        }
    }

    public function getSessionId()
    {
        return session_id();
    }

    public function set($name, $value)
    {
        $this->_params[$name] = $value;
    }

    public function add($name, $info)
    {
        if (!isset($this->_params[$name]) || !is_array($this->_params[$name])) {
            $this->_params[$name] = array();
        }

        $this->_params[$name][] = $info;
    }

    public function get($name)
    {
        return isset($this->_params[$name]) ? $this->_params[$name] : null;
    }

    public function remove($name)
    {
        unset($this->_params[$name]);
    }

    public function close()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {

            $_SESSION['app_params'] = json_encode($this->_params);
            session_write_close();
        }
    }

    public function clear()
    {
        $_SESSION = array();
        $this->_params = array();
        session_destroy();
    }

    /**
     * устанавливаем в сессии, что пользователь авторизован
     * @param type $userId
     */
    public function setIsAuth($userId)
    {
        $this->set('auth', 1);
        $this->set('userId', $userId);
    }

    public function isAuth()
    {
        return $this->get('auth') === 1;
    }

}
