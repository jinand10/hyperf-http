<?php

declare(strict_types=1);

namespace App\Service;

use App\Dao\ServerDao;
use Hyperf\Di\Annotation\Inject;

class ServerService
{
    /**
     * @Inject
     * @var ServerDao
     */
    protected $serverDao;

    /**
     * @param int $srvId
     * @return array
     */
    public function one(int $srvId): array
    {
        $info = $this->serverDao->firstByWhere(['srv_id' => $srvId]);
        return ['info' => $info];
    }
}