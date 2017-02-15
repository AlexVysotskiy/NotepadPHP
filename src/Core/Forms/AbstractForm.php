<?php

namespace Core\Forms;

/**
 * Description of AbstractValidator
 *
 * @author Alexander
 */
class AbstractForm implements IValidator
{

    /**
     * 
     */
    protected $_fields = array();

    /**
     * @var type 
     */
    protected $_validators = array();

    public function __construct($fields = array())
    {
        $this->_fields = $fields;
    }

    public function validate()
    {
        /* @var $validator AbstractValidator */
        foreach ($this->_validators as $validator) {


            if (isset($this->_fields[$validator->getField()])) {

                $validator->setValue($this->_fields[$validator->getField()]);
                if (!$validator->validate()) {
                    throw new \Core\Exceptions\FormValidationFailedException();
                }
            } else {
                throw new \Core\Exceptions\FormValidationFailedException();
            }
        }

        return true;
    }

    public function setFields($fields)
    {
        $this->_fields = $fields;
    }

    public function addValidator(AbstractValidator $validator)
    {
        $this->_validators[] = $validator;
    }

}
