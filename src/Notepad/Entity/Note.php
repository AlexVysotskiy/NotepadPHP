<?php

namespace Notepad\Entity;

use DB\Entity;

/**
 * Description of User
 *
 * @author Alexander
 */
class Note extends Entity
{

    const ENTITY_TYPE = 'note';

    /**
     * 
     * @var 
     */
    protected $id = null;

    /**
     * 
     * @var 
     */
    protected $header = null;

    /**
     *
     * @var 
     */
    protected $text = null;

    /**
     *
     * @var 
     */
    protected $owner = null;

    /**
     * 
     */
    protected $creation = null;

    /**
     *
     * @var 
     */
    protected $removed = null;

    public function __construct()
    {
        if ($this->creation !== null) {

            $this->creation = \DateTime::createFromFormat('Y-m-d H:i:s', $this->creation);
        } else {
            $this->creation = new \DateTime();
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

    public function isRemoved()
    {
        return $this->removed == 1;
    }

    public function setRemoved($removed)
    {
        $this->removed = $removed ? 1 : 0;
        return $this;
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function getCreationDate()
    {
        return $this->creation;
    }

    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    public function setCreationDate(\DateTime $creation)
    {
        $this->creation = $creation;
        return $this;
    }

    public function fromArray($params)
    {
        
    }

    public function toArray()
    {
        $result = array(
            'id' => $this->id,
            'header' => $this->header,
            'text' => $this->text,
            'creation' => $this->creation->format('Y-m-d H:i:s'),
            'owner' => $this->owner,
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
