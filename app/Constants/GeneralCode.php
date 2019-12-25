<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

class GeneralCode
{
    /**
     * 调用者-客户端
     */
    const CALLER_CLIENT = 1;
    /**
     * 调用者-服务端
     */
    const CALLER_SERVER = 2;
    /**
     * 调用者-运维
     */
    const CALLER_OPS = 3;
}