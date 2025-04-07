<?php

namespace Auth\App\Services;

use Auth\Domain\Models\Users;
use Auth\Domain\Repository\UsersRepository;
use Nurymbet\Core\Shared\Auth\Password;
use Nurymbet\Route\Http\JsonResponse;
use Nurymbet\Route\Http\Request;

class SignUpService
{
    private Request $request;

    public function __construct()
    {
        $this->request = Request::getInstance();
    }

    public function index(): JsonResponse
    {
        $param = $this->request->get('param');

        $response = UsersRepository::set([
            'login' => $param['login'],
            'email' => $param['email'],
            'avatar' => $param['avatar'],
            'name' => $param['name'],
            'role' => json_encode($param['role']),
            'password' => Password::hash($param['password']),
            'status' => 'active',
        ]);

        if ($response['code'] === '200') {
            return new JsonResponse(200, ['message' => 'Пользователь успешно создан!']);
        }
        if ($response['code'] === '23505') {
            preg_match('/Key \((.*?)\)=\((.*?)\)/', $response['message'], $matches);
            if (isset($matches[1]) && isset($matches[2])) {
                if ($matches[1] === 'login') {
                    return new JsonResponse(400, ['message' => 'Логин уже занят']);
                }

                if ($matches[1] === 'email') {
                    return new JsonResponse(400, ['message' => 'Почта уже занят']);
                }
                return new JsonResponse(400, ['message' => 'Поле ' . $matches[1] . ' с значением ' . $matches[2] . ' уже существует!']);
            }
        }
        return new JsonResponse(200, ['message' => 'Ошибка при создание пользователя!']);
    }
}
