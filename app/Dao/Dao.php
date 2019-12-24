<?php

declare(strict_types=1);

namespace App\Dao;

use Hyperf\DbConnection\Db;

abstract class Dao
{
    /**
     * @var string
     */
    protected $model;

    /**
     * @var string
     */
    protected $name;

    /**
     * 获取模型操作对象
     * @return \App\Kernel\Database\QueryBuilder
     */
    protected function model()
    {
        /** @var \App\Kernel\Database\QueryBuilder $model */
        $model = $this->model::query();
        return $model;
    }

    /**
     * @param array $data
     * @param null $sequence
     * @return int
     */
    public function insertGetId(array $data, $sequence = null)
    {
        return $this->model()->insertGetId($data, $sequence = null);
    }

    public function firstByWhere(array $where, $columns = ['*'], $timeout = 0)
    {
        return $this->model()->where($where)->remember($timeout)->first($columns);
    }

    /**
     * @param array $where
     * @param array $columns
     * @param int $timeout
     * @return \App\Kernel\Database\QueryBuilder|\Hyperf\Database\Model\Model|object|null
     */
    public function getByWhere(array $where, $columns = ['*'], $timeout = 0)
    {
        return $this->model()->where($where)->remember($timeout)->get($columns);
    }
}