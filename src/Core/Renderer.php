<?php

namespace Core;

/**
 * Description of Renderer
 *
 * @author Alexander
 */
class Renderer
{

    public static function render($file, $data)
    {
        $filePath = ROOT_PATH . '/templates/' . $file;
        if (file_exists($filePath)) {

            extract($data);

            ob_start();
            include($filePath);
            $response = ob_get_contents();
            ob_end_clean();
            return $response;
        } else {
            throw new \Exception(sprintf('Template %s not exists', $filePath));
        }
    }

}
