<?php

namespace DB\Connection;

use DB\Settings;

/**
 * Description of Factory
 *
 * @author Alexander
 */
class Factory
{

    public static function getConnection($type, Settings $settings = null)
    {
        switch ($type) {
            case 'mysql':
                return new MySQLConnection($settings);
            default:
                throw new \Exception(sprintf('Unsupported %s connection type!', $type));
        }
    }

}
