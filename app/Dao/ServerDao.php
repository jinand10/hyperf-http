<?php

declare(strict_types=1);

namespace App\Dao;

use App\Model\ServerModel;

class ServerDao extends Dao
{
    protected $model = ServerModel::class;

    protected $name = '服务器';

}