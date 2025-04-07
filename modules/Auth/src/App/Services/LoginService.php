<?php

namespace Auth\App\Services;

use Auth\Domain\Models\Users;
use Nurymbet\Core\Shared\Auth\Password;
use Nurymbet\Core\Shared\Auth\Token;
use Nurymbet\Route\Http\JsonResponse;
use Nurymbet\Route\Http\Request;

class LoginService
{
    private Request $request;

    public function __construct()
    {
        $this->request = Request::getInstance();
    }

    public function index(): JsonResponse
    {
        $param = $this->request->get('param');

        $user = Users::find('login', $param['login'])::limit()::flush();

        if (!empty($user) && $user['code'] === '200') {
            if (!empty($user['data'])) {
                if (Password::verify($param['password'], $user['data']['password'])) {
                    return new JsonResponse(200, ['message' => 'Успешная авторизация!', 'token' => Token::encode([
                        'id' => $user['data']['id']
                    ])]);
                }
            }
            return new JsonResponse(200, ['message' => 'Неверный логин или пароль!']);
        }
        return new JsonResponse(200, ['message' => 'Ошибка при получение данных!']);
    }
}
