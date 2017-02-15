<?php

namespace DB\Query\Mysql;

use DB\Query\Mysql;

/**
 * @author Alexander
 */
class Insert extends Mysql
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
        $sql = 'INSERT INTO ' . $this->_table . ' (' . implode(', ', $this->_fields) . ') values ';

        $list = array_fill(0, count($this->_fields), '?');
        
        $list = array_fill(0, $this->_count, '(' . implode(', ', $list) . ')');

        $sql .= implode(', ', $list);

        return $sql;
    }

    public function setFields($fields)
    {
        $this->_fields = $fields;
    }

    public function setInsertCount($count)
    {
        $this->_count = $count;
    }

}
