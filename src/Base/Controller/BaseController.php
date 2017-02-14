<?php

namespace Base\Controller;

use Core\Http\Controller\AbstractController;
use Core\Http\Request;

class BaseController extends AbstractController
{

    public function defaultAction(Request $request)
    {
        return $this->render('main');
    }

}
