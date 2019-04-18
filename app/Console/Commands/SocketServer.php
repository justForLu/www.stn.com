<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SocketServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'socket:server';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        set_time_limit(0);
        $ip = '127.0.0.1';
        $port = 1935;
        /*
         +-------------------------------
         *    @socket通信整个过程
         +-------------------------------
         *    @socket_create
         *    @socket_bind
         *    @socket_listen
         *    @socket_accept
         *    @socket_read
         *    @socket_write
         *    @socket_close
         +--------------------------------
        */
        /*----------------    以下操作都是手册上的    -------------------*/
        if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) < 0) { // 创建一个Socket链接
            echo "socket_create() 失败的原因是:" . socket_strerror($sock) . "\n";
        }
        if (($ret = socket_bind($sock, $ip, $port)) < 0) { //绑定Socket到端口
            echo "socket_bind() 失败的原因是:" . socket_strerror($ret) . "\n";
        }
        if (($ret = socket_listen($sock, 4)) < 0) { // 开始监听链接链接
            echo "socket_listen() 失败的原因是:" . socket_strerror($ret) . "\n";
        }
        $count = 0;
        do {
            if (($msgsock = socket_accept($sock)) < 0) { //堵塞等待另一个Socket来处理通信
                echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
                break;
            } else {
                //发送消息到客户端
                $msg = "测试成功！\n";
                socket_write($msgsock, $msg, strlen($msg));
                //接收客户端消息
                echo "测试成功了啊\n";

                do{
                    $buf = socket_read($msgsock, 8192); // 获得客户端的输入
                }while(strlen($buf) != 0);

                $talkback = "收到的信息:$buf\n";
                echo $talkback;
                if (++$count >= 5) {
                    break;
                };
            }
            //echo $buf;
            socket_close($msgsock);
        } while (true);
        socket_close($sock);
    }
}
