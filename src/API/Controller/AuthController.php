<?php

namespace API\Controller;

use Core\Http\Controller\AbstractController;
use Core\Http\Request;
use Core\Http\Response\Json;

/**
 * Description of AuthController
 *
 * @author Alexander
 */
class AuthController extends AbstractController
{

    public function auth(Request $request)
    {
        $result = array(
            'success' => 0
        );

        try {

            /* @var $userKit \Notepad\Kit\UsersKit */
            $userKit = $this->get('users_kit');
            if ($user = $userKit->authUser($request->get('login'), $request->get('password'))) {

                $auth = $this->get('api_kit')->updateAuth($user->getId());


                $result = array_merge($result, array(
                    'success' => 1,
                    'token' => $auth->getHash(),
                    'valid' => $auth->getValid()->getTimestamp()
                ));
            } else {

                $result['error'] = 'Пользователь с таким логином уже существует';
            }
        } catch (\Core\Exceptions\FormValidationFailedException $e) {

            throw $e;

            $result['error'] = 'Проверьте правильность заполнения полей!';
        } catch (\Exception $e) {

            throw $e;

            $result['error'] = 'Возникли ошибки во время регистрации';
        }

        return new Json($result);
    }

    public function registration(Request $request)
    {
        $result = array(
            'success' => 0
        );

        try {

            /* @var $userKit \Notepad\Kit\UsersKit */
            $userKit = $this->get('users_kit');
            if ($user = $userKit->registerUser($request->get('login'), $request->get('password'))) {

                /* @var $auth \API\Entity\Auth */
                $auth = $this->get('api_kit')->updateAuth($user->getId());

                $result = array_merge($result, array(
                    'success' => 1,
                    'token' => $auth->getHash(),
                    'valid' => $auth->getValid()->getTimestamp()
                ));
            } else {

                $result['error'] = 'Пользователь с таким логином уже существует';
            }
        } catch (\Core\Exceptions\FormValidationFailedException $e) {

            $result['error'] = 'Проверьте правильность заполнения полей!';
        } catch (\Exception $e) {

            $result['error'] = 'Возникли ошибки во время регистрации';
        }

        return new Json($result);
    }

    public function user(Request $request)
    {
        $result = array(
            'success' => 0
        );

        $userId = intval($request->get('userId'));
        /* @var $userKit \Notepad\Kit\UsersKit */
        $userKit = $this->get('users_kit');

        /* @var $user \Notepad\Entity\User */
        if (($token = $request->get('token')) && ($user = $userKit->getUser($userId) )) {

            /* @var $auth \API\Entity\Auth */
            $isValid = $this->get('api_kit')->checkToken($user->getId(), $token);

            if ($isValid) {

                $userInfo = array(
                    'id' => $user->getId(),
                    'login' => $user->getLogin(),
                    'registration' => $user->getRegistration()->getTimestamp()
                );

                $result = array_merge($result, array('success' => 1, 'user' => $userInfo));
            } else {
                $result['error'] = 'Требуется авторизация!';
            }
        } else {
            $result['error'] = 'Отсутствуют обязательные параметры или пользователь с указанным id не найден.';
        }


        return new Json($result);
    }

}
