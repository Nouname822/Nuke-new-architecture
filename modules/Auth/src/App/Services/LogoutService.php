<?php

namespace Auth\App\Services;

use Auth\Domain\Models\BlackList;
use Nurymbet\Route\Http\JsonResponse;
use Nurymbet\Route\Http\Request;

class LogoutService
{
    private Request $request;

    public function __construct()
    {
        $this->request = Request::getInstance();
    }

    public function index(): JsonResponse
    {
        $token = $this->request->get('auth');

        $blackList = BlackList::create(['token' => str_replace('Bearer ', '', $token)])::flush();

        if ($blackList['code'] === '200' || $blackList['code'] === '23505') {
            return new JsonResponse(200, ['message' => 'Вы успешно вышли с учетной записи!']);
        }
        return new JsonResponse(500, ['message' => 'Ошибка при выходе из учетной записи!']);
    }
}
