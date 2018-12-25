<?php
/**
 * Tag
 *
 * Created by PhpStorm.
 * User: Flying Oranges
 * Date: 2018/12/25
 * Time: 11:35 AM
 */

namespace App\vender\Auth;

use App\vender\Redis\RedisUtils;

class AuthUtils
{
    /**
     * Tag 实现登录信息共享
     *
     * Users Flying Oranges
     * CreateTime 2018/12/25
     * @param object $user
     */
    public static function login(object $user)
    {
        RedisUtils::setRedis($user->token, 60 * 24 * 30, $user);
    }

    /**
     * Tag 实现退出登录
     *
     * Users Flying Oranges
     * CreateTime 2018/12/25
     */
    public static function logout()
    {
        $token = request()->header('Authorization');
        RedisUtils::delRedis($token);
    }

    /**
     * Tag 实现判断是否登录
     *
     * Users Flying Oranges
     * CreateTime 2018/12/25
     * @return mixed
     */
    public static function check()
    {
        $token = request()->header('Authorization');
        return RedisUtils::existsRedis($token);
    }

    /**
     * Tag 实现用户信息反馈
     *
     * Users Flying Oranges
     * CreateTime 2018/12/25
     * @return string
     */
    public static function user()
    {
        $token = request()->header('Authorization');

        return RedisUtils::getRedis($token);
    }

    /**
     * Tag 实现用户编号反馈
     *
     * Users Flying Oranges
     * CreateTime 2018/12/25
     * @return mixed
     */
    public static function id()
    {
        return self::user()->id;
    }


}