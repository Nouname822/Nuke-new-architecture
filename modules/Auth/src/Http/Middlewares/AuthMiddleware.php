<?php

namespace Auth\Http\Middlewares;

use Nurymbet\Core\Http\MiddlewareInterface;
use Nurymbet\Route\Http\JsonResponse;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(): JsonResponse|string
    {
        return 'next';
    }
}
