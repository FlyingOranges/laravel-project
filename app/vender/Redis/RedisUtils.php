<?php
/**
 * Tag redis操作封装
 *
 * Created by PhpStorm.
 * User: Flying Oranges
 * Date: 2018/12/25
 * Time: 10:26 AM
 */

namespace App\vender\Redis;

use \Closure;
use Illuminate\Support\Facades\Redis;

class RedisUtils
{
    /**
     * Tag redis操作model数据方法
     *
     * Users Flying Oranges
     * CreateTime 2018/12/25
     * @param $key
     * @param $minutes
     * @param Closure $callback
     * @return mixed|object
     */
    public static function remember($key, $minutes, Closure $callback)
    {
        $value = Redis::get($key);

        /**
         * 如果reids缓存中有值,则直接返回
         */
        if (!is_null($value)) {
            return (object)json_decode($value, true);
        }

        //直接从方法中获取值,然后转换成json字符串存储到redis
        $value = $callback();
        Redis::setex($key, $minutes * 60, json_encode($value));

        return $value;
    }
}