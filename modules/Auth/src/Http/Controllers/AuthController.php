<?php

namespace Auth\Http\Controllers;

use Auth\App\Services\CheckService;
use Auth\App\Services\LoginService;
use Auth\App\Services\LogoutService;
use Auth\App\Services\SignUpService;
use Nurymbet\Core\Http\Controller;
use Nurymbet\Route\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(): JsonResponse
    {
        return $this->execService(LoginService::class, 'index');
    }

    public function signup(): JsonResponse
    {
        return $this->execService(SignUpService::class, 'index');
    }

    public function logout(): JsonResponse
    {
        return $this->execService(LogoutService::class, 'index');
    }

    public function check(): JsonResponse
    {
        return $this->execService(CheckService::class, 'index');
    }
}
