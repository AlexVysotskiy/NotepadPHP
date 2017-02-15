<?php

namespace API\Controller;

use Core\Http\Controller\AbstractController;
use Core\Http\Request;
use Core\Http\Response\Json;

/**
 * Description of NotesController
 *
 * @author Alexander
 */
class NotesController extends AbstractController
{

    public function __construct(\Core\Container $container)
    {
        parent::__construct($container);

        /* @var $request Request */
        $request = $this->get('request');

        if (($token = $request->get('token')) && ($userId = $request->get('userId'))) {

            /* @var $auth \API\Entity\Auth */
            $isValid = $this->get('api_kit')->checkToken($userId, $token);
            if (!$isValid) {

                $response = new Json(array(
                    'success' => 0,
                    'error' => 'Необходима авторизация!'
                ));

                $response->send();
                exit;
            }
        } else {

            $response = new Json(array(
                'success' => 0,
                'error' => 'Отсутствуют обязательные параметры или пользователь с указанным id не найден.'
            ));

            $response->send();
            exit;
        }
    }

    public function note(Request $request)
    {
        $result = array(
            'success' => 0
        );

        $noteId = intval($request->get('noteId'));

        /* @var $user \Notepad\Entity\User */
        $user = $this->get('users_kit')->getUser($request->get('userId'));

        /* @var $notesKit \Notepad\Kit\NotesKit */
        $notesKit = $this->get('notes_kit');

        /* @var $note \Notepad\Entity\Note */
        if (($note = $notesKit->getNote($noteId, $user->getId()))) {

            $result = array_merge($result, array(
                'success' => 1,
                'note' => array(
                    'id' => $note->getId(),
                    'header' => $note->getHeader(),
                    'text' => $note->getText(),
                    'creationDate' => $note->getCreationDate()->getTimestamp()
                )
            ));
        } else {
            $result['error'] = 'Запись отсутствует';
        }


        return new Json($result);
    }

    public function notesList(Request $request)
    {
        $result = array(
            'success' => 0
        );

        $page = abs(intval($request->get('page')));

        /* @var $user \Notepad\Entity\User */
        $user = $this->get('users_kit')->getUser($request->get('userId'));

        /* @var $notesKit \Notepad\Kit\NotesKit */
        $notesKit = $this->get('notes_kit');

        /* @var $notes  \DB\Model\Paginator */
        if (($notes = $notesKit->getNotesList($user->getId(), $page))) {

            $notesInfo = array(
                'total' => $notes->getTotal(),
                'page' => $page,
                'pegPage' => $notes->getLimit(),
                'list' => array()
            );

            foreach ($notes->getValue() as $note) {
                $notesInfo['list'][$note->getId()] = array(
                    'id' => $note->getId(),
                    'header' => $note->getHeader(),
                    'text' => $note->getText(),
                    'creationDate' => $note->getCreationDate()->getTimestamp()
                );
            }


            $result = array_merge($result, array(
                'success' => 1,
                'notes' => $notesInfo
            ));
        } else {
            $result['error'] = 'Запись отсутствует';
        }


        return new Json($result);
    }

    public function addNote(Request $request)
    {
        $result = array(
            'success' => 0
        );

        /* @var $user \Notepad\Entity\User */
        $user = $this->get('users_kit')->getUser($request->get('userId'));

        /* @var $notesKit \Notepad\Kit\NotesKit */
        $notesKit = $this->get('notes_kit');

        try {

            if ($note = $notesKit->createNote($user, $request->get('header'), $request->get('text'))) {

                $result = array_merge($result, array(
                    'success' => 1,
                    'note' => array(
                        'id' => $note->getId(),
                        'header' => $note->getHeader(),
                        'text' => $note->getText(),
                        'creationDate' => $note->getCreationDate()->getTimestamp()
                    )
                ));
            } else {
                $result['error'] = 'Проверьте правильность заполнения полей!';
            }
        } catch (\Core\Exceptions\FormValidationFailedException $e) {

            $result['error'] = 'Проверьте правильность заполнения полей!';
        } catch (\Exception $e) {

            $result['error'] = 'Возникли ошибки во время создания заявки!';
        }

        return new Json($result);
    }

    public function editNote(Request $request)
    {
        $result = array(
            'success' => 0
        );

        /* @var $user \Notepad\Entity\User */
        $user = $this->get('users_kit')->getUser($request->get('userId'));

        /* @var $notesKit \Notepad\Kit\NotesKit */
        $notesKit = $this->get('notes_kit');

        $noteId = $request->get('noteId');

        try {

            /* @var $note \Notepad\Entity\Note */
            if (($note = $notesKit->getNote($noteId, $user->getId()))) {

                if ($header = $request->get('header')) {
                    $note->setHeader($header);
                }

                if ($text = $request->get('text')) {
                    $note->setText($text);
                }

                if ($notesKit->saveNote($note)) {

                    $result = array_merge($result, array(
                        'success' => 1,
                        'note' => array(
                            'id' => $note->getId(),
                            'header' => $note->getHeader(),
                            'text' => $note->getText(),
                            'creationDate' => $note->getCreationDate()->getTimestamp()
                        )
                    ));
                }
            } else {
                $result['error'] = 'Проверьте правильность заполнения полей!';
            }
        } catch (\Core\Exceptions\FormValidationFailedException $e) {

            $result['error'] = 'Проверьте правильность заполнения полей!';
        } catch (\Exception $e) {

            $result['error'] = 'Возникли ошибки во время создания заявки!';
        }

        return new Json($result);
    }

    public function removeNote(Request $request)
    {
        $result = array(
            'success' => 0
        );

        /* @var $user \Notepad\Entity\User */
        $user = $this->get('users_kit')->getUser($request->get('userId'));

        /* @var $notesKit \Notepad\Kit\NotesKit */
        $notesKit = $this->get('notes_kit');

        $noteId = $request->get('noteId');

        try {

            /* @var $note \Notepad\Entity\Note */
            if (($note = $notesKit->getNote($noteId, $user->getId()))) {

                $note->setRemoved(true);
                $notesKit->saveNote($note);

                $result = array(
                    'success' => 1
                );
            }
        } catch (\Exception $e) {

            $result['error'] = 'Возникли ошибки во время удаления заявки!';
        }

        return new Json($result);
    }

}
