<?php

namespace Core\Forms;

/**
 * Description of AbstractValidator
 *
 * @author Alexander
 */
abstract class AbstractValidator implements IValidator
{

    /**
     * по
     * @var type 
     */
    protected $_field = null;

    /**
     *
     * @var type 
     */
    protected $_value = null;

    public function __construct($field = null, $value = null)
    {
        $this->setField($field);
        $this->setValue($value);
    }

    public function getField()
    {
        return $this->_field;
    }

    public function setField($field)
    {
        $this->_field = $field;
    }

    public function setValue($value)
    {
        $this->_value = $value;
    }

    protected function getType()
    {
        throw new \Exception('Method not defined!');
    }

}
