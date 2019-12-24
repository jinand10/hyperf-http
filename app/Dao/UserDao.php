<?php

declare(strict_types=1);

namespace App\Dao;

use App\Model\UserModel;
use Hyperf\Redis\RedisFactory;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Cache\Annotation\Cacheable;

class UserDao extends Dao
{
    protected $model = UserModel::class;

    protected $name = '用户';

}