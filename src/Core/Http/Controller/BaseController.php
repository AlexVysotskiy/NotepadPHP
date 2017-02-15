<?php

namespace Core\Http\Controller;

use Core\Http\Controller\AbstractController;
use Core\Http\Request;
use Core\Http\Response\Json;

/**
 * Description of BaseController
 *
 * @author Alexander
 */
class BaseController extends AbstractController
{

    public function install(Request $request)
    {
        
        /* @var $dbConnection \DB\Driver\MySQLDriver */
        $dbConnection = $this->get('db.driver.mysql');

        /* @var $connection \PDO */
        $connection = $dbConnection->getConnection()->getConnection();

        $connection->query("CREATE TABLE IF NOT EXISTS users (
id bigint(20) unsigned NOT NULL,
  login varchar(50) NOT NULL,
  password varchar(32) NOT NULL,
  registration datetime DEFAULT NULL,
  removed int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;");

        $connection->query("CREATE TABLE IF NOT EXISTS api_auth (
  id int(11) NOT NULL,
  hash varchar(32) NOT NULL,
  valid datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        $connection->query("CREATE TABLE IF NOT EXISTS note (
id bigint(20) unsigned NOT NULL,
  header varchar(255) NOT NULL,
  text text NOT NULL,
  creation datetime NOT NULL,
  owner int(11) NOT NULL,
  removed int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;");


        $connection->query("ALTER TABLE api_auth ADD PRIMARY KEY (id);");
        $connection->query("ALTER TABLE note ADD UNIQUE KEY id (id);");
        $connection->query("ALTER TABLE users ADD UNIQUE KEY id (id);");

        $connection->query("ALTER TABLE note MODIFY id bigint(20) unsigned NOT NULL AUTO_INCREMENT;");

        $connection->query("ALTER TABLE users MODIFY id bigint(20) unsigned NOT NULL AUTO_INCREMENT;");

        return new Json(array('success' => 1));
    }

}
