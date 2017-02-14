<?php

namespace Core\Http\Response;

use Core\Http\Response;

/**
 * Description of Json
 *
 * @author Alexander
 */
class Json extends Response
{

    public function send()
    {
        // status
        header(sprintf('HTTP/%s %s %s', '1.0', '200', 'OK'), true, '200');
        header('Content-Type: application/json');

        echo json_encode($this->content);

        return $this;
    }

}
