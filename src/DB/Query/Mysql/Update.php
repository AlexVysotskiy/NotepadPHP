<?php

namespace DB\Query\Mysql;

use DB\Query\Mysql;

/**
 * @author Alexander
 */
class Update extends Mysql
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
        $sql = 'UPDATE ' . $this->_table . ' SET ';

        foreach ($this->_fields as $field) {
            $sql .= $field . '= :' . $field . ', ';
        }
        
        $sql = rtrim($sql, ', ');
        
        return $sql . ' ' . parent::compile();
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
