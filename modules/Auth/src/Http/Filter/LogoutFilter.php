<?php

namespace Auth\Http\Filter;

use Nurymbet\Core\Error\Log;
use Nurymbet\Core\Http\Filter;
use Nurymbet\Core\Shared\Auth\Token;
use Nurymbet\Route\Http\JsonResponse;
use Nurymbet\Route\Http\Request;

class LogoutFilter extends Filter
{
    public function handle(): string|JsonResponse
    {
        try {
            $token = Request::getInstance()->get('auth');

            if (isset($token)) {
                $token = Token::decode($token);

                if (!empty($token) && $token['exp'] > time()) {
                    return 'next';
                } else {
                    return new JsonResponse(400, ['message' => 'Токен не валиден!']);
                }
            }

            return new JsonResponse(400, ['message' => 'Введите токен!']);
        } catch (\Throwable $th) {
            Log::write('Error', $th->getMessage(), $th->getFile(), $th->getLine());
            return new JsonResponse(400, ['message' => 'Введите токен!']);
        }
    }
}
