<?php

namespace Notepad\Controller;

use Core\Http\Controller\AbstractController;

/**
 * Description of BaseController
 *
 * @author Alexander
 */
class BaseController extends AbstractController
{

    protected $_currentUser = null;

    protected function render($view, $data = array())
    {
        $data['user'] = $this->getCurrentUser();

        return parent::render($view, $data);
    }

    /**
     * 
     * @return \Notepad\Entity\User | null
     */
    protected function getCurrentUser()
    {
        if (!$this->_currentUser) {
            $session = $this->getSession();
            if ($session->isAuth()) {
                $this->_currentUser = $this->get('users_kit')->getUser($session->get('userId'));
            }
        }

        return $this->_currentUser;
    }

}
