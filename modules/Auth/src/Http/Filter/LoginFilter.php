<?php

namespace Auth\Http\Filter;

use Nurymbet\Core\Error\Log;
use Nurymbet\Core\Http\Filter;
use Nurymbet\Route\Http\JsonResponse;
use Nurymbet\Route\Http\Request;

class LoginFilter extends Filter
{
    public function handle(): string|JsonResponse
    {
        try {
            $request = Request::getInstance()->get('param');

            if (!static::required($request)) {
                return new JsonResponse(400, ['message' => 'Введите логин и пароль!']);
            }

            if (!isset($request['login'])) {
                return new JsonResponse(400, ['message' => 'Введите логин!']);
            }

            if (!isset($request['password'])) {
                return new JsonResponse(400, ['message' => 'Введите пароль!']);
            }

            if (static::validateLength($request['login'], 3, 50) && static::validateLength($request['password'], 3, 50)) {
                return 'next';
            } else {
                return new JsonResponse(400, ['message' => 'Логин и Пароль должен быть не менее 3 и не более 50 символов!']);
            }

            return new JsonResponse(400, ['message' => 'Заполните все поля!']);
        } catch (\Throwable $th) {
            Log::write('Error', $th->getMessage(), $th->getFile(), $th->getLine());
            return new JsonResponse(400, ['message' => 'Заполните все поля!']);
        }
    }
}
