<?php

declare(strict_types=1);

namespace App\Service;

use App\Constants\ApiCode;
use App\Dao\UserDao;
use App\Exception\ApiException;
use Hyperf\Di\Annotation\Inject;

class UserService
{
    /**
     * @Inject
     * @var UserDao
     */
    protected $userDao;

    /**
     * @param string $name
     * @param string $password
     * @param string $phone
     * @return array
     */
    public function register(string $name, string $password, string $phone): array
    {
        $uid = $this->userDao->insertGetId([
            'name' => $name,
            'password' => $password,
            'phone' => $phone,
            'create_time' => time(),
            'update_time' => time(),
        ]);
        if (! $uid) {
            throw new ApiException(ApiCode::INSERT_FAILED);
        }
        return ['uid' => $uid];
    }

    /**
     * @param string $phone
     * @param string $password
     * @return array
     */
    public function login(string $phone, string $password): array
    {
        $userInfo = $this->userDao->firstByWhere(['phone' => $phone, 'password' => $password], ['*'], 10);
        if (! $userInfo) {
            throw new ApiException(ApiCode::PASSWORD_ERROR);
        }
        return ['userInfo' => $userInfo];
    }

    /**
     * @param int $uid
     * @return array
     */
    public function info(int $uid): array
    {
        $userInfo = $this->userDao->firstByWhere(['id' => $uid], ['*'], 10);
        return ['userInfo' => $userInfo];
    }
}