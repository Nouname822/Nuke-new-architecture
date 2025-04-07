<?php

use Auth\Http\Controllers\AuthController;
use Auth\Http\Filter\LoginFilter;
use Auth\Http\Filter\LogoutFilter;
use Auth\Http\Filter\SignUpFilter;
use Nurymbet\Route\Auth\Route;

Route::group('/admin/auth/', 'admin.auth', [], function () {
    Route::post('login', 'login', [AuthController::class, 'login'], [], ['filters' => [[LoginFilter::class]]]);
    Route::post('signup', 'signup', [AuthController::class, 'signup'], [], ['filters' => [[SignUpFilter::class]]]);
    Route::post('logout', 'logout', [AuthController::class, 'logout'], [], ['filters' => [[LogoutFilter::class]]]);
    Route::head('check', 'check', [AuthController::class, 'check'], [], ['filters' => [[LogoutFilter::class]]]);
});
