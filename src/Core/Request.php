<?php

namespace Core;

use Core\Request\Session;
use Core\Request\Cookie;

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
        
        $this->session = new Session();
        $this->cookie = new Cookie();
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

}
