# 介绍
Grpc 模块

# 安装

```shell
php bin/hyperf.php hcms:install grpc
```

### grpc.proto

```protobuf
syntax = "proto3";

package grpc;

service hi {
  rpc sayHello (RequestMessage) returns (ResponseMessage) {
  }
}

message RequestMessage {
  string method = 1;
  string argument = 2;
}

message ResponseMessage {
  int32 code = 1;
  string data = 2;
  string msg = 3;
}
```

### 使用 protoc 自动生成代码
`protoc --php_out=grpc/ grpc.proto`
执行完成后会发现多了一个 `grpc` 目录

### 安装composer
```shell
# 服务端
composer require hyperf/grpc-server
# 用户端
composer require hyperf/grpc-client
```

### 添加服务
需要到`server.php` 配置文件，添加服务
```php 
        [
            'name' => 'grpc',
            'type' => Server::SERVER_HTTP,
            'host' => '0.0.0.0',
            'port' => 9503,
            'sock_type' => SWOOLE_SOCK_TCP,
            'callbacks' => [
                Event::ON_REQUEST => [\Hyperf\GrpcServer\Server::class, 'onRequest'],
            ],
        ]
```

### 添加路由
```php
Router::addServer('grpc', function () {
    Router::addGroup('/grpc.hi', function () {
        Router::post('/sayHello', 'App\Application\Grpc\Controller\GrpcController@index');
    });
});
```

### 访问
访问 `http://127.0.0.1:9501/grpc/client/index` 看到成的json返回，就代表配置成功


### 常见问题
建议在 `annotations.php` 文件中，添加忽略注解文件，因为自动生成的代码会有 @type Hyperf默认当成注解。
```php
  'ignore_annotations' => [
            'mixin',
            'type'
        ],
```
