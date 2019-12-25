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
use App\Model\ServerModel;
use App\Service\ServerService;
use App\Service\UserService;
use App\Validation\CommonValidation;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

/**
 * @Controller()
 */
class ServerController extends AbstractController
{
    /**
     * @Inject
     * @var CommonValidation
     */
    protected $validation;

    /**
     * @Inject
     * @var ValidatorFactoryInterface
     */
    protected $validationFactory;

    /**
     * @Inject
     * @var ServerService
     */
    protected $serverService;

    /**
     * @RequestMapping(path="one", methods="post")
     */
    public function one()
    {
        $data = json_decode($this->request->input('data', ''), true);
        if (!$data) {
            throw new ValidationException('data error');
        }

        $validator = $this->validationFactory->make(
            $data,
            $this->validation->rule('server', 'one'),
            $this->validation->message('server', 'one'),
            $this->validation->attribute('server', 'one')
        );
        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->first());
        }
        return $this->response->success(
            $this->serverService->one($data['srv_id'])
        );
    }

}
