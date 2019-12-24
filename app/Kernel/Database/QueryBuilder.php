<?php

declare(strict_types=1);

namespace App\Kernel\Database;

use Hyperf\Database\Query\Builder;

/**
 * Class QueryBuilder
 * @author jin <jinand10@163.com>
 */
class QueryBuilder extends Builder
{
    protected $cacheTimeout = 0;

    /**
     * @param int $cacheTimeout
     * @return $this
     */
    public function remember(int $cacheTimeout = 0)
    {
        $this->cacheTimeout = $cacheTimeout;
        return $this;
    }

    /**
     * @return array|mixed
     */
    protected function runSelect()
    {
        /**
         * 判断是否设置缓存
         */
        if ($this->cacheTimeout <= 0) {
            return parent::runSelect();
        }
        /*
         * 获取key.
         */
        $key = 'db_cache:'.md5($this->toSql() . serialize($this->getBindings()) . $this->cacheTimeout);

        if (redis('cache')->exists($key)) {
            return unserialize(redis('cache')->get($key));
        }
        /*
        * 获取数据.
        */
        $data = parent::runSelect();
        /*
         * 更新缓存
         */
        redis('cache')->set($key, serialize($data), $this->cacheTimeout);
        /*
         * 返回数据
         */
        return $data;
    }
}
