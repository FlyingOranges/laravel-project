<?php
/**
 * Tag
 *
 * Created by PhpStorm.
 * User: Flying Oranges
 * Date: 2018/12/24
 * Time: 9:26 AM
 */

namespace App\Http\Service\Impl;


use App\Exceptions\ApiException;
use App\Http\Service\AuthService;
use App\Models\UserModel;

class AuthServiceImpl implements AuthService
{
    /**
     * Users Flying Oranges
     * CreateTime 2018/12/24
     * @param array $user
     * @return mixed
     * @throws \Throwable
     */
    public function register(array $user)
    {
        //初始设定用户昵称为账号
        $user['nickname'] = $user['username'];
        $UserModel = new UserModel();

        //判断是否已有该账号
        $repeatResult = $UserModel->repeatUsername($user['username']);
        throw_unless($repeatResult, ApiException::class, '该账户已被注册');

        $user['password'] = md5($user['password']);

        return $UserModel->createUser($user);
    }

    /**
     * Tag 实现登录服务
     *     考虑到有可能多服务器运行程序,所以此登录方案采用redis做共享session
     * Users Flying Oranges
     * CreateTime 2018/12/25
     * @param array $user
     * @throws \Throwable
     */
    public function login(array $user)
    {
        //验证码
        $code = '1234';
        $codeState = $user['code'] == $code ? true : false;
        throw_unless($codeState, ApiException::class, '验证码不正确');

        $UserModel = new UserModel();

        //使用账号查询用户信息是否存在
        $userResult = $UserModel->login($user['username']);
        throw_unless($userResult, ApiException::class, '没有该账户信息');

        //判断密码信息是否正确
        $passwordState = $userResult->password == md5($user['password']) ? true : false;
        throw_unless($passwordState, ApiException::class, '密码信息错误,请重新尝试');

//        if ($userResult->password != )


    }


}