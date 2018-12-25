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

    protected $fillable = ['nickname', 'username', 'password'];

    protected $dateFormat = 'U';

    public function createUser(array $user)
    {
        return $this->create($user);
    }

    //判断当前账号是否可用
    public function repeatUsername(string $username)
    {
        $result = RedisUtils::remember('USER_NAME_REPEAT_STRING_' . $username,
            60 * 24 * 30, function () use ($username) {
                $result = $this->where('username', $username)->first(['id']);

                return $result ? true : false;
            });

        return $result;
    }

    //获取登录信息
    public function login(string $username)
    {
        $result = RedisUtils::remember('USER_LOGIN_USERNAME_' . $username,
            60 * 24, function () use ($username) {
                return $this->where(['username' => $username])
                    ->first(['id', 'username', 'password', 'nickname', 'status']);
            });

        return $result;
    }

}
