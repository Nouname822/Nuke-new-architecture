<?php

namespace Auth\Http\Filter;

use Nurymbet\Core\Error\Log;
use Nurymbet\Core\Http\Filter;
use Nurymbet\Route\Http\JsonResponse;
use Nurymbet\Route\Http\Request;

class SignUpFilter extends Filter
{
    public function handle(): string|JsonResponse
    {
        try {
            $request = Request::getInstance()->get('param');

            if (!static::required($request)) {
                return new JsonResponse(400, ['message' => 'Данные не переданы']);
            }

            $fields = [
                'login' => 'Введите логин!',
                'email' => 'Введите почту!',
                'avatar' => 'Загрузите аватарку!',
                'name' => 'Введите имя!',
                'role' => 'Назначьте роль!',
                'password' => 'Введите пароль!',
            ];

            foreach ($fields as $field => $errorMessage) {
                if (!isset($request[$field]) || !static::required($request[$field])) {
                    return new JsonResponse(400, ['message' => $errorMessage]);
                }
            }

            if (!static::validateLength($request['login'], 3, 50)) {
                return new JsonResponse(400, ['message' => 'Логин должен быть от 3 до 50 символов']);
            }

            if (!static::validateLength($request['name'], 2, 50)) {
                return new JsonResponse(400, ['message' => 'Имя должно быть от 2 до 50 символов']);
            }

            if (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
                return new JsonResponse(400, ['message' => 'Неверный формат почты']);
            }

            if (!static::validateLength($request['password'], 5, 50)) {
                return new JsonResponse(400, ['message' => 'Пароль должен быть от 6 до 50 символов']);
            }

            if (!is_string($request['avatar']) || strlen($request['avatar']) < 10) {
                return new JsonResponse(400, ['message' => 'Некорректный аватар']);
            }

            if (!is_array($request['role']) || !isset($request['role'][0])) {
                return new JsonResponse(400, ['message' => 'Укажите роль!']);
            }

            return 'next';
        } catch (\Throwable $th) {
            Log::write('Error', $th->getMessage(), $th->getFile(), $th->getLine());
            return new JsonResponse(400, ['message' => 'Произошла ошибка при обработке запроса']);
        }
    }
}
