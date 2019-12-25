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

namespace App\Controller;

use App\Exception\ValidationException;
use App\Service\UserService;
use App\Validation\UserValidation;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

/**
 * @Controller()
 */
class UserController extends AbstractController
{
    /**
     * @Inject
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;

    /**
     * @Inject
     * @var UserService
     */
    protected $userService;

    /**
     * @Inject
     * @var UserValidation
     */
    protected $userValidation;

    /**
     * @RequestMapping(path="register", methods="post")
     */
    public function register()
    {
        $params = $this->request->getParsedBody();
        $validator = $this->validationFactory->make(
            $params,
            $this->userValidation->registerRule(),
            $this->userValidation->registerMessage(),
            $this->userValidation->registerAttribute()
        );
        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->first());
        }
        return $this->response->success(
            $this->userService->register($params['name'], $params['password'], $params['phone'])
        );
    }

    /**
     * @RequestMapping(path="login", methods="post")
     */
    public function login()
    {
        $params = $this->request->getParsedBody();
        $validator = $this->validationFactory->make(
            $params,
            $this->userValidation->loginRule(),
            $this->userValidation->loginMessage(),
            $this->userValidation->loginAttribute()
        );
        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->first());
        }
        return $this->response->success(
            $this->userService->login($params['phone'], $params['password'])
        );
    }

    /**
     * @RequestMapping(path="info", methods="get")
     */
    public function info()
    {
        return $this->response->success(
            $this->userService->info((int)$this->request->input('uid', 0))
        );
    }
}
