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

    /**
     * Tag 用户注册
     *
     * Users Flying Oranges
     * CreateTime 2018/12/28
     * @param AuthRequest $authRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AuthRequest $authRequest)
    {
        $result = $this->authService->register($authRequest->only(['username', 'password', 'code']));
        return responseJson($result, '注册成功');
    }
}
