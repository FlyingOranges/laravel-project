<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthRequest;
use App\Http\Service\AuthService;
use App\Http\Controllers\Controller;

class RegisteredController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(AuthRequest $authRequest)
    {
        $result = $this->authService->register($authRequest->only(['username', 'password', 'password_confirmation']));
        return responseJson($result, '注册成功');
    }
}
