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
     * Tag 设置有期限redis
     *
     * Users Flying Oranges
     * CreateTime 2018/12/25
     * @param string $key
     * @param int $minutes
     * @param $value
     */
    public static function setRedis(string $key, int $minutes, $value)
    {
        Redis::setex($key, $minutes, json_encode($value));
    }

    /**
     * Tag 设置无期限redis
     *
     * Users Flying Oranges
     * CreateTime 2018/12/25
     * @param string $key
     * @param $value
     */
    public static function setRedisUnlimited(string $key, $value)
    {
        Redis::set($key, json_encode($value));
    }

    /**
     * Tag 判断是否redis是否存在
     *
     * Users Flying Oranges
     * CreateTime 2018/12/25
     * @param string $key
     * @return mixed
     */
    public static function existsRedis(string $key)
    {
        return Redis::exists($key);
    }

    /**
     * Tag 删除指定的key
     *
     * Users Flying Oranges
     * CreateTime 2018/12/25
     * @param string $key
     * @return mixed
     */
    public static function delRedis(string $key)
    {
        return Redis::del($key);
    }

    /**
     * Tag 获取redis信息
     *
     * Users Flying Oranges
     * CreateTime 2018/12/25
     * @param string $key
     * @return string
     */
    public static function getRedis(string $key)
    {
        $value = Redis::get($key);

        return json_encode($value, true);
    }

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