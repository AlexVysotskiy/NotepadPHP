<?php

namespace Core\Forms\Validator;

use Core\Forms\AbstractValidator;

/**
 * @author Alexander
 */
class RegexValidator extends AbstractValidator
{

    protected $_regex = null;

    public function __construct($field = null, $value = null, $regex = null)
    {
        $this->setRegex($regex);

        parent::__construct($field, $value);
    }

    public function setRegex($regex)
    {
        $this->_regex = $regex;
    }

    public function getRegex()
    {
        return $this->_regex;
    }

    public function validate()
    {
        return preg_match($this->_regex, $this->_value);
    }

}
