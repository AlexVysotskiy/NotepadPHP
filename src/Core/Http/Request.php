<?php

namespace Core\Http;

use Core\Http\Request\Session;
use Core\Http\Request\Cookie;

/**
 * Description of Request
 *
 * @author Alexander
 */
class Request
{

    /**
     * запрошенный путь
     * @var string 
     */
    protected $uri = null;

    /**
     *
     * @var mixed 
     */
    protected $request = array();

    /**
     *
     * @var mixed 
     */
    protected $server = array();

    /**
     *
     * @var Session 
     */
    public $session = null;

    /**
     *
     * @var Cookie 
     */
    public $cookie = null;

    public function __construct()
    {
        $this->request = $_REQUEST;
        $this->server = $_SERVER;

        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

        $this->uri = preg_replace('/\?.+$/', '', $uri);
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function get($param)
    {
        return isset($this->request) ? $this->request[$param] : (isset($this->server[$param]) ? $this->server[$param] : null);
    }

    public function set($param, $value)
    {
        $this->request[$param] = $value;
    }

    public function setSession(Session $session)
    {
        $this->session = $session;
    }

    public function setCookie(Cookie $cookie)
    {
        $this->cookie = $cookie;
    }

}
