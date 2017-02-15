<?php

namespace Notepad\Controller;

use Notepad\Controller\BaseController;
use Core\Http\Request;

/**
 * Description of NotesController
 *
 * @author Alexander
 */
class NotesController extends BaseController
{

    public function profile(Request $request)
    {
        $user = $this->getCurrentUser();

        /* @var $kit \Notepad\Kit\NotesKit */
        $kit = $this->get('notes_kit');

        $page = abs(intval($request->get('page')));

        $list = $kit->getNotesList($user->getId(), $page);

        $this->assign('notes', $list);

        return $this->render('profile');
    }

    public function editNote(Request $request)
    {
        $user = $this->getCurrentUser();

        /* @var $kit \Notepad\Kit\NotesKit */
        $kit = $this->get('notes_kit');

        $noteId = intval($request->get('noteId'));

        /* @var $note \Notepad\Entity\Note */
        if ($note = $kit->getNote($noteId, $user->getId())) {

            if ($request->isMethod('post')) {

                try {

                    $header = $request->get('header');
                    $text = $request->get('text');

                    $note->setHeader($header);
                    $note->setText($text);


                    if ($kit->saveNote($note)) {

                        return $this->redirectByRoute('profile');
                    } else {

                        $this->assign('error', 'Проверьте правильность заполнения полей!');
                    }
                } catch (\Core\Exceptions\FormValidationFailedException $e) {

                    $this->assign('error', 'Проверьте правильность заполнения полей!');
                } catch (\Exception $e) {

                    $this->assign('error', 'Возникли ошибки во время создания заявки!');
                }
            }

            $this->assign('note', $note);

            return $this->render('add_note');
        }

        return $this->redirectByRoute('profile');
    }

    public function removeNote(Request $request)
    {
        $user = $this->getCurrentUser();

        /* @var $kit \Notepad\Kit\NotesKit */
        $kit = $this->get('notes_kit');

        $noteId = intval($request->get('noteId'));

        /* @var $note \Notepad\Entity\Note */
        if ($note = $kit->getNote($noteId, $user->getId())) {

            $note->setRemoved(true);
            $kit->saveNote($note);
        }

        return $this->redirectByRoute('profile');
    }

    public function addNote(Request $request)
    {
        $user = $this->getCurrentUser();

        /* @var $kit \Notepad\Kit\NotesKit */
        $kit = $this->get('notes_kit');

        if ($request->isMethod('post')) {

            try {

                if ($kit->createNote($user, $request->get('header'), $request->get('text'))) {

                    return $this->redirectByRoute('profile');
                } else {
                    $this->assign('error', 'Проверьте правильность заполнения полей!');
                }
            } catch (\Core\Exceptions\FormValidationFailedException $e) {

                $this->assign('error', 'Проверьте правильность заполнения полей!');
            } catch (\Exception $e) {

                $this->assign('error', 'Возникли ошибки во время создания заявки!');
            }
        }

        return $this->render('add_note');
    }

}
