<?php

namespace Core\Request;

class Cookie
{

    protected $_params = array();

    public function __construct()
    {
        $this->_params = $_COOKIE;
    }

    public function set($name, $value = "", $expire = 0, $path = "", $domain = "")
    {
        setcookie($name, $value, $expire, $path, $domain);
        $this->_params[$name] = $value;
    }

    public function get($name)
    {
        return isset($this->_params[$name]) ? $this->_params[$name] : null;
    }

    public function remove()
    {
        unset($this->_params[$name]);
        setcookie($name, null, -1);
    }

}
