<?php

namespace Notepad\Controller;

use Notepad\Controller\BaseController;
use Core\Http\Request;

/**
 * Description of AuthController
 *
 * @author Alexander
 */
class AuthController extends BaseController
{

    /**
     * авторизация
     * @param Request $request
     */
    public function auth(Request $request)
    {
        if ($request->isMethod('post')) {

            /* @var $userKit \Notepad\Kit\UsersKit */
            $userKit = $this->get('users_kit');

            try {

                if ($user = $userKit->authUser($request->get('login'), $request->get('password'))) {

                    $this->getSession()->setIsAuth($user->getId());
                    
                    return $this->redirectByRoute('profile');
                } else {
                    $this->assign('error', 'Вы ввели неверный логин/пароль!');
                }
            } catch (\Exception $e) {

                $this->assign('error', 'Возникли ошибки во время авторизации');
            }
        }

        return $this->render('login');
    }

    /**
     * регистрация
     * @param Request $request
     */
    public function registration(Request $request)
    {

        if ($request->isMethod('post')) {

            /* @var $userKit \Notepad\Kit\UsersKit */
            $userKit = $this->get('users_kit');

            try {

                if ($user = $userKit->registerUser($request->get('login'), $request->get('password'))) {

                    $this->getSession()->setIsAuth($user->getId());
                    
                    return $this->redirectByRoute('profile');
                } else {
                    $this->assign('error', 'Пользователь с таким логином уже существует');
                }
            } catch (\Core\Exceptions\FormValidationFailedException $e) {

                $this->assign('error', 'Проверьте правильность заполнения полей!');
            } catch (\Exception $e) {

                $this->assign('error', 'Возникли ошибки во время регистрации');
            }
        }
        return $this->render('registration');
    }

    public function logout(Request $request)
    {
        $this->get('session')->clear();

        return $this->redirectByRoute('login');
    }

}
