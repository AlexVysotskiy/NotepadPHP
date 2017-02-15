<?php

namespace Notepad\Entity;

use DB\Entity;

/**
 * Description of User
 *
 * @author Alexander
 */
class User extends Entity
{

    const ENTITY_TYPE = 'user';

    /**
     * 
     * @var 
     */
    protected $id = null;

    /**
     *
     * @var 
     */
    protected $login = null;

    /**
     *
     * @var 
     */
    protected $password = null;

    /**
     * 
     */
    protected $registration = null;

    /**
     *
     * @var type 
     */
    protected $removed = null;

    public function __construct()
    {
        if ($this->registration !== null) {

            $this->registration = \DateTime::createFromFormat('Y-m-d H:i:s', $this->registration);
        } else {
            $this->registration = new \DateTime();
        }

        if ($this->removed === null) {
            $this->removed = 0;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRegistration()
    {
        return $this->registration;
    }

    public function isRemoved()
    {
        return $this->removed == 1;
    }

    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setRemoved($removed)
    {
        $this->removed = $removed;
        return $this;
    }

    public function setRegistration(\DateTime $time)
    {
        $this->registration = $time;
    }

    public function fromArray($params)
    {
        
    }

    public function toArray()
    {
        $result = array(
            'id' => $this->id,
            'login' => $this->login,
            'password' => $this->password,
            'registration' => $this->registration->format('Y-m-d H:i:s'),
            'removed' => $this->removed
        );


        foreach ($result as $key => $value) {
            if ($value === null) {
                unset($result[$key]);
            }
        }
        
        return $result;
    }

    public function getType()
    {
        return self::ENTITY_TYPE;
    }

}
