<?php

namespace Notepad\Kit;

use Core\Kit\AbstractKit;
use Notepad\Entity\Note;

/**
 * @author Alexander
 */
class NotesList extends AbstractKit
{

    /**
     *
     * @var \DB\EntityManager
     */
    protected $_entityManager = null;

    public function getNotesList($ownerId, $page = 0, $limit = 30)
    {
        $criteria = array(
            'owner' => array('eq', 'owner', $ownerId),
            'removed' => array('eq', 'removed', 0)
        );

        $list = $this->_entityManager->select(Note::ENTITY_TYPE, $criteria, array(
            'creation' => 'DESC'
                ), $page, $limit);

        $total = $this->_entityManager->count(Note::ENTITY_TYPE, $criteria);

        return new \DB\Model\Paginator($page, $limit, $total, $list);
    }

    public function getNote($id, $ownerId = null)
    {
        /* @var $note Note */
        $note = $this->_entityManager->selectOne(Note::ENTITY_TYPE, array(
            'id' => array('eq', 'id', $id),
            'removed' => array('eq', 'removed', 0),
        ));

        if ($note && $ownerId) {

            return $note->getOwner() == $ownerId ? $note : null;
        }

        return $note;
    }

    public function createNote(\Notepad\Entity\User $user, $header, $text)
    {
        if ($this->validateFields(array('header' => $header, 'text' => $text))) {

            $note = new Note();
            $note->setOwner($user->getId());
            $note->setHeader($header);
            $note->setText($text);

            $this->_entityManager->getDriver()->insert($note);

            return $note->getId();
        }

        return false;
    }

    public function saveNote(Note $note)
    {
        if ($this->validateFields(array('header' => $note->getHeader(), 'text' => $note->getText()))) {

            if ($note->getOwner()) {

                $this->_entityManager->getDriver()->update($note);
                return true;
            }
        }

        return false;
    }

    protected function validateFields($fields)
    {
        $form = new \Notepad\Forms\NoteForm($fields);

        return $form->validate();
    }

    public function setEntityManager($entityManager)
    {
        $this->_entityManager = $entityManager;
    }

}
