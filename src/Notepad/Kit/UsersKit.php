<?php

namespace Notepad\Kit;

use Core\Kit\AbstractKit;
use Notepad\Entity\User;

/**
 * @author Alexander
 */
class UsersKit extends AbstractKit
{

    /**
     *
     * @var \DB\EntityManager
     */
    protected $_entityManager = null;

    /**
     *
     * @var type 
     */
    protected $_authSettings = null;

    /**
     * сессия
     * @var \Core\Http\Request\Session 
     */
    protected $_session = null;

    public function authUser($login, $password)
    {
        if ($this->validateFields(array('login' => $login, 'password' => $password))) {

            /* @var $user User */
            $user = $this->_entityManager->selectOne(User::ENTITY_TYPE, array(
                'login' => array('eq', 'login', $login)
            ));

            if ($user && $user->getPassword() == $this->calculatePaswordHash($password)) {
                return $user;
            }
        }

        return false;
    }

    public function registerUser($login, $password)
    {
        if ($this->validateFields(array('login' => $login, 'password' => $password))) {

            $user = $this->_entityManager->selectOne(User::ENTITY_TYPE, array(
                'login' => array('eq', 'login', $login)
            ));
            
            if (!$user) {

                $user = new User();
                $user->setLogin($login);
                $user->setPassword($this->calculatePaswordHash($password));
                
                $this->_entityManager->getDriver()->insert($user);
                
//                $this->_session->setIsAuth($user->getId());
                
                return $user;
            }
        }

        return false;
    }

    /**
     * 
     * @param type $login
     * @param type $password
     * @return User
     */
    public function getUser($userId)
    {
        return $this->_entityManager->selectOne(User::ENTITY_TYPE, array(
                    'id' => array('eq', 'id', $userId)
        ));
    }

    protected function validateFields($fields)
    {
        $form = new \Notepad\Forms\AuthForm($fields);

        return $form->validate();
    }

    protected function calculatePaswordHash($password)
    {
        return md5($this->_authSettings['passwod.sault'] . $password . strrev($this->_authSettings['passwod.sault']));
    }

    public function setEntityManager($entityManager)
    {
        $this->_entityManager = $entityManager;
    }

    public function setAuthSettings($authSettings)
    {
        $this->_authSettings = $authSettings;
    }

    public function setSession($session)
    {
        $this->_session = $session;
    }

}
