## 设置环境变量
- .env 文件中修改
- BROADCAST_DRIVER=redis
- QUEUE_CONNECTION=sync
- redis的主机端口密码

广播驱动好像只能选择 redis 其他的都不能应用于生产

队列驱动可以选择redis 这里我为了不开启队列 所以选择同步

## 前端添加依赖

- npm install laravel-echo@2 socket.io-client@2 --save-dev

也可以不添加

那么就必须在使用页面的时候 通过cdn引入 或者 服务端自动提供的 /socket.io/socket.io.js

一定要注意版本 服务端用的什么版本的socket.io 客户端应该引入与之对应的大版本 socket.io-client

## 前端引入并设置

- resources/js/bootstrap.js

## 前端编码

- resources/views/welcome.blade.php

## 前端安装其他依赖并编译

- npm install && npm run watch

## 服务端安装依赖

- npm install laravel-echo-server --save

全局不全局安装都行 只要能把服务开起来就可以 这里不用全局 调用的时候前面多加个 npx

这个服务端并不是 laravel 官方提供的

虽然它和官方提供的 laravel-echo 名字很像

但大家都用它 github 开源的

## 服务端初始化

- npx laravel-echo-server init

一路回车 反正还得看着配置文件修改 "devMode": false 如果使用的 redis 不是本机或者有密码 还得修改 "redis": {"host":"xxx","password":"xxx"}

## 运行服务端

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




  

