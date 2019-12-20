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
        $uid = $this->userDao->insertGetUid($name, $password, $phone);
        if (! $uid) {
            throw new ApiException(ApiCode::INSERT_FAILED);
        }
        return ['uid' => $uid];
    }

    public function login(string $phone, string $password): array
    {
        $userInfo = $this->userDao->getUserInfo(['phone' => $phone, 'password' => $password]);
        if (! $userInfo) {
            throw new ApiException(ApiCode::PASSWORD_ERROR);
        }
        return ['userInfo' => $userInfo];
    }
}