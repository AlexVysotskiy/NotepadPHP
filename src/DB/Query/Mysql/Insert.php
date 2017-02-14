<?php

namespace DB\Query\Mysql;

use DB\Query\Mysql;

/**
 * @author Alexander
 */
class Insert extends Mysql
{

    protected $_criteria = array();

    public function compile()
    {
        return 'DELETE FROM ' . $this->_table . parent::compile();
    }

}
