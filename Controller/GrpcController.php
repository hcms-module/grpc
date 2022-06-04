<?php

declare(strict_types=1);

namespace App\Application\Grpc\Controller;

use Grpc\RequestMessage;
use Grpc\ResponseMessage;
use Hyperf\Utils\Codec\Json;

class GrpcController
{

    function index(RequestMessage $request)
    {
        $res = new ResponseMessage();
        $res->setCode(200)
            ->setData(Json::encode(['res' => 1] + Json::decode($request->getArgument())))
            ->setMsg('ok');
        return $res;
    }
}
