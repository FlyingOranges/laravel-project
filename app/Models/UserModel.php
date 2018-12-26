<?php

namespace App\Models;

use App\vender\Redis\RedisUtils;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Model
{
    use SoftDeletes;

    const STATUS_NORMAL = 1;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = ['nickname', 'username', 'password', 'token'];

    protected $dateFormat = 'U';

    public function createUser(array $user)
    {
        return $this->create($user);
    }

    //判断当前账号是否可用
    public function repeatUsername(string $username)
    {
        $status = RedisUtils::getRedis('USER_NAME_REPEAT_STRING_' . $username);

        if ($status and !is_null($status)) {
            //如果能找到标示为真,则直接返回不可使用
            $repeat = false;
        } else {
            //如果找不到到标示
            $result = $this->where('username', $username)->first(['id']);
            if ($result) {
                RedisUtils::setRedisUnlimited('USER_NAME_REPEAT_STRING_' . $username, false);
                $repeat = false;
            } else {
                RedisUtils::setRedisUnlimited('USER_NAME_REPEAT_STRING_' . $username, true);
                $repeat = true;
            }
        }

        return $repeat;
    }

    //获取登录信息
    public function login(string $username)
    {
        $result = RedisUtils::remember('USER_LOGIN_USERNAME_' . $username,
            60 * 24, function () use ($username) {
                return $this->where(['username' => $username])
                    ->first(['id', 'username', 'password', 'nickname', 'token', 'status']);
            });

        return $result;
    }

}
