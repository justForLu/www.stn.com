# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).


## 系统变量

Hotel Web环境变量配置
<code>
APP_DEBUG   调试模式
APP_KEY     应用KEY
APP_URL     应用地址
JWT_SECRET  JWT Token密码
DB_HOST         数据库IP
DB_PORT         数据库端口
DB_DATABASE     数据库名
DB_USERNAME     用户名
DB_PASSWORD     密码
REDIS_HOST      Redis IP
REDIS_PASSWORD  Redis密码
REDIS_PORT      Redis端口
REDIS_PREFIX    Redis前缀
SWOOLE_CONNECT_HOST     客控服务端地址
UDP_PORT            UDP Socket PORT
WS_PORT             Web Socket端口
TCP_PORT            TCP Socket端口
UDP_PORT            UDP Socket端口

</code>


Hotel Server环境变量配置
<code>
SWOOLE_HOST         客控服务端监听IP
WS_PORT             Web Socket端口
TCP_PORT            TCP Socket端口
UDP_PORT            UDP Socket端口
SW_NAME             进程名称
SW_WORKERNUM        进程数
SW_DAEMONIZE        启用守护进程
SW_PID_FILE         MASTER进程的PID文件
SW_LOG_FILE         守护进程日志文件
</code>


## 配置说明

PHP需开启SOCKET、SOAP扩展








