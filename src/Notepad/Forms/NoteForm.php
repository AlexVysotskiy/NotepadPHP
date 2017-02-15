<?php

namespace Notepad\Forms;

use Core\Forms\AbstractForm;

class NoteForm extends AbstractForm
{

    public function __construct($fields = array())
    {
        parent::__construct($fields);

        // для логина
        $this->addValidator(new \Core\Forms\Validator\RegexValidator('header', null, '/^.{1,255}$/'));

        // для пароля
        $this->addValidator(new \Core\Forms\Validator\RegexValidator('text', null, '/^.{1,500}$/'));
    }

}
