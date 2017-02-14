<?php

namespace Core\Http\Response;

use Core\Http\Response;

/**
 * @author Alexander
 */
class Redirect extends Response
{

    public function send()
    {
        // status
        header('Location: ' . $this->getRedirectUrl());
        exit;
    }

    public function setRedirectUrl($url)
    {
        $this->setContent($url);
    }

    public function getRedirectUrl()
    {
        return $this->getContent();
    }

}
