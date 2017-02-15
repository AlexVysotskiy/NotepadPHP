<?php

namespace Core\ConfigReader;

use Core\ConfigReader;

/**
 *
 *
 * @author Alexander
 */
class PhpFileReader extends ConfigReader
{

    public function read()
    {
        if (isset($this->_settings['type'])) {

            $path = ROOT_PATH . '/configs/' . $this->_settings['type'] . '.php';

            if (file_exists($path)) {

                $params = include $path;
                return $params;
                
            } else {
                throw new \Exception(sprintf('Config %s file not exists!', $path));
            }
        } else {

            throw new \Exception('Config type not defined!');
        }
    }

}
