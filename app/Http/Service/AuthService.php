<?php
/**
 * Tag
 *
 * Created by PhpStorm.
 * User: Flying Oranges
 * Date: 2018/12/24
 * Time: 9:26 AM
 */

namespace App\Http\Service;


interface AuthService
{
    //注册用户
    public function register(array $user);

    //登录用户
    public function login(array $user);
}