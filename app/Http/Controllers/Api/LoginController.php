<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;
use App\Http\Service\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    private $authServer;

    public function __construct(AuthService $authService)
    {
        $this->authServer = $authService;
    }

    /**
     * Tag 登录操作
     *
     * Users Flying Oranges
     * CreateTime 2018/12/25
     * @param LoginRequest $loginRequest
     * @return mixed
     */
    public function login(LoginRequest $loginRequest)
    {
        return $this->authServer->login($loginRequest->only(['username', 'password']));
    }
}
