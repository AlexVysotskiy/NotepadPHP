<?php

namespace DB\Query\Mysql;

use DB\Query\Mysql;

/**
 * @author Alexander
 */
class Select extends Mysql
{

    /**
     *
     * @var type 
     */
    protected $_fields = array();

    /**
     * сколько строк будем вставлять
     * @var type 
     */
    protected $_count = array();

    public function compile()
    {
        $sql = 'SELECT ' . implode(', ', $this->_fields) . ' FROM ' . $this->_table;
        $sql .= ' ' . parent::compile();

        return $sql;
    }

    public function setFields($fields)
    {
        $this->_fields = $fields;
    }

}
