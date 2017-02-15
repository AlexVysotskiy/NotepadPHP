<?php

namespace DB\Query\Mysql;

/**
 * Используем это для компиляции условий
 *
 * @author Alexander
 */
class Where
{

    /**
     * список условий
     * @var type 
     */
    protected $_list = array();

    public function compile()
    {
        return implode(' AND ', $this->_list);
    }

    public function eq($column, $value)
    {
        $this->_list[] = $column . '=' . (is_numeric($value) ? $value : '\'' . ((string) $value) . '\'');
    }

    public function gt($column, $value)
    {
        $this->_list[] = $column . '>' . ((string) $value);
    }

    public function gte($column, $value)
    {
        $this->_list[] = $column . '>=' . ((string) $value);
    }

    public function lt($column, $value)
    {
        $this->_list[] = $column . '<' . ((string) $value);
    }

    public function lte($column, $value)
    {
        $this->_list[] = $column . '<=' . ((string) $value);
    }

    public function like($column, $value)
    {
        $this->_list[] = $column . ' LIKE \'%' . ((string) $value) . '%\'';
    }

    public function in($column, $value)
    {
        if (is_array($value) && $value) {

            $this->_list[] = $column . ' IN (' . implode(',', $value) . ')';
        }
    }

    public function notin($column, $value)
    {
        if (is_array($value) && $value) {

            $this->_list[] = $column . ' NOT IN (' . implode(',', $value) . ')';
        }
    }

    public function isnull($column)
    {
        $this->_list[] = $column . ' IS NULL';
    }

    public function isnotnull($column)
    {
        $this->_list[] = $column . ' IS NOT NULL';
    }

    public function add($type, $column, $value)
    {
        if (method_exists($this, $type)) {

            $this->$type($column, $value);
        } else {
            throw new \DB\Exception\DBException(sprintf('Unknown %s predicade in where clause!', $type));
        }
    }

}
