<?php

namespace Auth\App\Services;

use Auth\Domain\Models\BlackList;
use Nurymbet\Route\Http\JsonResponse;
use Nurymbet\Route\Http\Request;

class CheckService
{
    private Request $request;

    public function __construct()
    {
        $this->request = Request::getInstance();
    }

    public function index(): JsonResponse
    {
        $token = $this->request->get('auth');

        $blackList = BlackList::find('token', str_replace('Bearer ', '', $token))::limit()::flush();

        if (empty($blackList['data'])) {
            return new JsonResponse(200, []);
        }
        return new JsonResponse(401, []);
    }
}
