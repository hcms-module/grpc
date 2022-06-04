<?php

declare(strict_types=1);

namespace App\Application\Grpc\Controller;

use App\Annotation\Api;
use App\Application\Grpc\Client\GrpcClient;
use Grpc\RequestMessage;
use App\Controller\AbstractController;
use Grpc\ResponseMessage;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\Utils\Codec\Json;

/**
 * @Controller(prefix="/grpc/client")
 */
class ClientController extends AbstractController
{

    /**
     * @Api()
     * @GetMapping(path="index")
     */
    public function index()
    {
        $client = new GrpcClient('127.0.0.1:9503', [
            'credentials' => null,
        ]);
        $request = new RequestMessage();
        $request->setMethod('request');
        $request->setArgument(Json::encode(['req' => 2]));
        /**
         * @var ResponseMessage $res
         */
        list($res, $status) = $client->sayHello($request);
        if ($res->getCode() === 200) {
            return Json::decode($res->getData());
        } else {
            return $this->returnErrorJson('请求错误');
        }
    }
}
