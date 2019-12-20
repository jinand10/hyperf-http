<?php

declare(strict_types=1);

namespace App\Dao;

use App\Model\UserModel;
use Hyperf\Redis\RedisFactory;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Cache\Annotation\Cacheable;

class UserDao
{
    /**
     * 新增用户
     * @param string $name
     * @param string $password
     * @param string $phone
     * @return int
     */
    public function insertGetUid(string $name, string $password, string $phone): int
    {
        return UserModel::query()->insertGetId([
            'name' => $name,
            'password' => $password,
            'phone' => $phone,
            'create_time' => time(),
            'update_time' => time(),
        ]);
    }

    public function getUserInfo(array $where, $columns = ['*'])
    {
        $data = UserModel::query()->where($where)->first($columns);
        return $data;
    }
}