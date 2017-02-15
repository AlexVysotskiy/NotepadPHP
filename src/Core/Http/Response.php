<?php

namespace Core\Http;

/**
 * Description of Request
 *
 * @author Alexander
 */
class Response
{

    protected $content = null;

    public function __construct($content = null)
    {
        $this->setContent($content);
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function send()
    {
        if (!headers_sent()) {
            header(sprintf('HTTP/%s %s %s', '1.0', '200', 'OK'), true, '200');
        }

        echo $this->content;

        return $this;
    }

}
