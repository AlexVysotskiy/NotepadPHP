<?php

namespace API\Kit;

use API\Entity\Auth;

/**
 * Description of MainKit
 *
 * @author Alexander
 */
class MainKit
{

    /**
     *
     * @var \DB\EntityManager
     */
    protected $_entityManager = null;

    public function updateAuth($userId)
    {
        $em = $this->_entityManager;

        $criteria = array(
            'id' => array('eq', 'id', $userId)
        );

        /* @var $auth Auth */
        if (!($auth = $em->selectOne(Auth::ENTITY_TYPE, $criteria))) {

            $auth = new Auth();
            $auth->setId($userId);
            $auth->setHash(md5(microtime(true)));

            $em->insert($auth);
        }

        $auth->setHash(md5(microtime(true)));
        $valid = new \DateTime();
        $valid->modify('+30 minutes');
        $auth->setValidDate($valid);

        $em->update($auth);

        return $auth;
    }

    public function getAuth($userId)
    {
        $em = $this->_entityManager;

        $criteria = array(
            'id' => array('eq', 'id', $userId)
        );
        /* @var $auth Auth */
        if ($auth = $em->selectOne(Auth::ENTITY_TYPE, $criteria)) {

            return $auth;
        }

        return false;
    }

    public function checkToken($userId, $token)
    {
        $em = $this->_entityManager;

        /* @var $auth Auth */
        if ($auth = $this->getAuth($userId)) {

            return $auth->isValid() && $auth->getHash() == $token;
        }

        return false;
    }

    public function setEntityManager($entityManager)
    {
        $this->_entityManager = $entityManager;
    }

}
