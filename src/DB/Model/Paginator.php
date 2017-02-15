<?php

namespace DB\Model;

/**
 * Description of Paginator
 *
 * @author Alexander
 */
class Paginator
{

    protected $_page = 0;
    protected $_limit = 0;
    protected $_total = 0;
    protected $_value = array();

    public function __construct($page, $limit, $total, $values)
    {
        $this->setPage($page);
        $this->setLimit($limit);
        $this->setTotal($total);
        $this->setValue($values);
    }

    public function getPage()
    {
        return $this->_page;
    }

    public function getLimit()
    {
        return $this->_limit;
    }

    public function getTotal()
    {
        return $this->_total;
    }

    public function getValue()
    {
        return $this->_value;
    }

    public function setPage($page)
    {
        $this->_page = abs(intval($page));
        return $this;
    }

    public function setLimit($limit)
    {
        $this->_limit = abs(intval($limit));
        return $this;
    }

    public function setTotal($total)
    {
        $this->_total = abs(intval($total));
        return $this;
    }

    public function setValue($value)
    {
        if (is_array($value)) {
            $this->_value = $value;
        }

        return $this;
    }

}
