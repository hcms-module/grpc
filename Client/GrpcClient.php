<?php
/**
 * Created by: zhlhuang (364626853@qq.com)
 * Time: 2022/6/3 09:51
 * Blog: https://www.yuque.com/huangzhenlian
 */

declare(strict_types=1);

namespace App\Application\Grpc\Client;

use Grpc\RequestMessage;
use Grpc\ResponseMessage;
use Hyperf\GrpcClient\BaseClient;

class GrpcClient extends BaseClient
{
    public function sayHello(RequestMessage $argument)
    {
        return $this->_simpleRequest('/grpc.hi/sayHello', $argument, [ResponseMessage::class, 'decode']);
    }
}