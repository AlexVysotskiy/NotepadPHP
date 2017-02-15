<?php

namespace API\Entity;

use DB\Entity;

/**
 * Description of Auth
 *
 * @author Alexander
 */
class Auth extends Entity
{

    const ENTITY_TYPE = 'apiAuth';

    /**
     * 
     * @var 
     */
    protected $id = null;

    /**
     *
     * @var 
     */
    protected $hash = null;

    /**
     * 
     */
    protected $valid = null;

    public function __construct()
    {
        if ($this->valid !== null) {

            $this->valid = \DateTime::createFromFormat('Y-m-d H:i:s', $this->valid);
        } else {

            $this->valid = new \DateTime();
            $this->valid->modify('+30 minutes');
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

    public function getHash()
    {
        return $this->hash;
    }

    public function getValid()
    {
        return $this->valid;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }

    public function setValidDate(\DateTime $valid)
    {
        $this->valid = $valid;
        return $this;
    }

    public function isValid()
    {
        return $this->valid->getTimestamp() > date('U');
    }

    public function fromArray($params)
    {
        
    }

    public function toArray()
    {
        $result = array(
            'id' => $this->id,
            'valid' => $this->valid->format('Y-m-d H:i:s'),
            'hash' => $this->hash
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
