## 修改配置文件

.env 文件中修改:

- BROADCAST_DRIVER=redis
- QUEUE_CONNECTION=sync
- redis的主机端口密码

广播驱动好像只能选择 redis 其他的都不能应用于生产

队列驱动可以选择redis 这里我为了不开启队列 所以选择同步

如果要发送私有广播还需要(公共广播可免操作):

- config/app.php 文件中取消注释-> App\Providers\EventServiceProvider::class (此服务提供者自动注册了一个路由 broadcasting/auth)
- (只有开启了上一步的服务提供者才能生效) routes/channels.php 文件中用 channel() 方法 对指定频道是否允许 socket 连接的逻辑判断 参数2是一个回调函数 函数的参数只有一个 框架用于鉴权的用户表实例

## 前端依赖

- npm install laravel-echo@2 --save-dev
- npm install socket.io-client@2 --save-dev

也可以不添加 那么就必须在使用页面的时候 通过cdn引入 或者 服务端自动提供的 /socket.io/socket.io.js

一定要注意版本 服务端用的什么版本的socket.io 客户端应该引入与之对应的大版本 socket.io-client

## 前端设置

- resources/js/bootstrap.js

## 前端编码

- resources/views/welcome.blade.php

## 前端运行

- npm install && npm run watch

## 服务端依赖

- npm install laravel-echo-server --save

全局不全局安装都行 只要能把服务开起来就可以 这里不用全局 调用的时候前面多加个 npx

这个服务端并不是 laravel 官方提供的

虽然它和官方提供的 laravel-echo 名字很像

但大家都用它 github 开源的

## 服务端设置

- npx laravel-echo-server init

一路回车 反正还得看着配置文件修改

"devMode": false 打开调试模式 服务端在收到事件的时候会打印 如果是私有广播 鉴权失败的时候也会打印一些信息

如果使用的 redis 不是本机或者有密码 还得修改 "redis": {"host":"xxx","password":"xxx"}

如果发送私有广播 authHost 字段必须填写正确 框架会在socket连接的时候鉴权 鉴权的地址就是 这个主机名上 加上 前面服务提供者注册的路由

## 服务端运行

- npx laravel-echo-server start

看到 ready! 且没有报错 表示运行起来了 还可以看到运行的默认端口是 6001

因为开了调试模式 所以之后发送事件的时候 会在此窗口打印一些信息

## 生成事件类并编辑

- php artisan make:event TestEvent
- app/Events/TestEvent.php

用事件类的属性传递消息的 属性一定要是共有的

## 触发事件

可以使用 tinker 也可以新加个路由 也可以新加一个artisan命令

- event(new App\Events\TestEvent("some message"))




  

