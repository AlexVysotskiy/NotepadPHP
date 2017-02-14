<?php

namespace DB\Query;

use DB\Query;

/**
 * @author Alexander
 */
abstract class Mysql extends Query
{

    /**
     * таблица
     * @var type 
     */
    protected $_table = null;

    /**
     *
     * @var type 
     */
    protected $_order = array();

    /**
     *
     * @var type 
     */
    protected $_limit = null;

    /**
     *
     * @var type 
     */
    protected $_page = null;

    /**
     *
     * @var Mysql\Where 
     */
    protected $_where = null;

    public function compile()
    {
        $sqlPattern = '';

        if ($where = $this->where()->compile()) {
            $sqlPattern .= ' WHERE ' . $where;
        }

        if ($this->_order) {

            $order = array();

            foreach ($this->_order as $column => $type) {
                $order[] = $column . '=' . $type;
            }

            $sqlPattern .= ' ORDER BY ' . implode(', ', $order);
        }

        if ($this->_limit !== null) {

            $sqlPattern .= ' LIMIT ' . ($this->_page !== null ? ($this->_page * $this->_limit) . ',' : '') . ' ' . $this->_limit;
        }

        return $sqlPattern;
    }

    public function setTable($table)
    {
        $this->_table = $table;
    }

    public function setOrder($order)
    {
        $this->_order = $order;
    }

    public function setLimit($limit)
    {
        $this->_limit = $limit;
    }

    public function setPage($page)
    {
        $this->_page = $page;
    }

    /**
     * 
     * @return Mysql\Where
     */
    public function where()
    {
        return $this->_where ? : ($this->_where = new Mysql\Where());
    }

}
