<?php

namespace Notepad\Forms;

use Core\Forms\AbstractForm;

class AuthForm extends AbstractForm
{

    public function __construct($fields = array())
    {
        parent::__construct($fields);

        // для логина
        $this->addValidator(new \Core\Forms\Validator\RegexValidator('login', null, '/^[a-zA-Z0-9\.-_]{3,10}$/'));

        // для пароля
        $this->addValidator(new \Core\Forms\Validator\RegexValidator('password', null, '/^.{3,50}$/'));
    }

}
