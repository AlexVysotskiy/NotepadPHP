<?php

namespace Core\ConfigReader;

/**
 * Description of Factory
 *
 * @author Alexander
 */
class Factory
{

    /**
     * 
     * @param type $type
     * @return \Core\ConfigReader
     * @throws \Exception
     */
    public static function getReader($type, $params = array())
    {
        switch ($type) {
            case 'php':
                {
                    return new PhpFileReader($params);
                }
            default:
                {
                    throw new \Exception('Config reader %s not defined', $type);
                }
        }
    }

}
