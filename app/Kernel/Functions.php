<?php

declare(strict_types=1);

use Hyperf\Utils\ApplicationContext;

if (!function_exists('di')) {
    /**
     * Finds an entry of the container by its identifier and returns it.
     * @param null|mixed $id
     * @return mixed|\Psr\Container\ContainerInterface
     */
    function di($id = null)
    {
        $container = ApplicationContext::getContainer();
        if ($id) {
            return $container->get($id);
        }
        return $container;
    }
}

if (!function_exists('stdoutLogger')) {
    /**
     * Finds an stdoutLogger of the container
     * @return \Hyperf\Contract\StdoutLoggerInterface|mixed
     */
    function stdoutLogger()
    {
        return ApplicationContext::getContainer()->get(\Hyperf\Contract\StdoutLoggerInterface::class);
    }
}

if (!function_exists('logger')) {
    /**
     * Finds an logger of the container
     * @param string $name
     * @param string $group
     * @return \Psr\Log\LoggerInterface
     */
    function logger($name = 'app', $group = 'default')
    {
        return ApplicationContext::getContainer()->get(\Hyperf\Logger\LoggerFactory::class)->get($name, $group);
    }
}

if (!function_exists('redis')) {
    /**
     * Finds an redis object of the container
     * @param string $poolName
     * @return \Hyperf\Redis\RedisProxy|Redis
     */
    function redis($poolName = 'default')
    {
        return ApplicationContext::getContainer()->get(\Hyperf\Redis\RedisFactory::class)->get($poolName);
    }
}
