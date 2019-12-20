<?php

declare(strict_types=1);

namespace App\Model;

/**
 * @property int $id
 * @property string $name 用户名
 * @property string $password 用户密码
 * @property string $phone 手机号
 * @property string $email 邮箱
 * @property int $last_login_time 最后登录时间
 * @property int $create_time 邮箱
 * @property int $update_time 更新时间
 */
class UserModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'password', 'phone', 'email', 'last_login_time', 'create_time', 'update_time'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'password' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'last_login_time' => 'integer',
        'create_time' => 'integer',
        'update_time' => 'integer'
    ];
}
