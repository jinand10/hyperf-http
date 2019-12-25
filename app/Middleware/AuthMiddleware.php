<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Constants\ApiCode;
use App\Constants\GeneralCode;
use App\Exception\ApiException;
use App\Kernel\Http\Response;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class AuthMiddleware 鉴权中间件
 * @author jin <jinand10@163.com>
 */
class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    public function __construct(ContainerInterface $container, Response $response, RequestInterface $request)
    {
        $this->container = $container;
        $this->response = $response;
        $this->request = $request;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $params = [];
        switch ($request->getMethod()) {
            case 'GET':
                $params = $request->getQueryParams();
                break;
            case 'POST':
                $params = $request->getParsedBody();
                break;
        }
        $data = (string)($params['data'] ?? '');
        $time = (int)($params['time'] ?? 0);
        $sign = (string)($params['sign'] ?? '');
        if (!$time || !$sign) {
            throw new ApiException(ApiCode::SIGN_ERROR);
        }
        /**
         * 调用者 1客户端 2服务端 3运维
         */
        $caller = (int)($this->request->query('caller', GeneralCode::CALLER_CLIENT));
        /**
         * 校验请求签名
         */
        if (!$this->verifySign($caller, $data, $time, $sign)) {
//            throw new ApiException(ApiCode::SIGN_ERROR);
        }
        return $handler->handle($request);
    }

    /**
     * 校验签名
     * @param int $caller
     * @param string $data
     * @param int $time
     * @param string $sign
     * @return bool
     */
    protected function verifySign(int $caller, string $data, int $time, string $sign): bool
    {
        $key = '';
        switch ($caller) {
            case GeneralCode::CALLER_CLIENT:
                $key = config('bee_client_key');
                break;
            case GeneralCode::CALLER_SERVER:
                $key = config('bee_server_key');
                break;
            case GeneralCode::CALLER_OPS:
                $key = config('bee_ops_key');
                break;
        }
        if (!$key || (md5($data.$time.$key) != $sign)) {
            return false;
        }
        return true;
    }
}
