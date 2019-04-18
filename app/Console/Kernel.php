<?php

namespace App\Console;

use GuzzleHttp\Client;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Mockery\CountValidator\Exception;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
         Commands\SocketServer::class,
         Commands\SocketClient::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $http_client = new Client();

        $schedule->call(function() use($http_client){
            try{
                $http_client->get($_ENV['APP_URL'] . "/hotel/cancelUnpaidOrder")->getBody()->getContents();
                Log::info('[cancelUnpaidOrder定时任务执行成功]');
            }catch(Exception $e){
                Log::info('[cancelUnpaidOrder定时任务执行失败]：' . $e->getMessage());
            }
        })->everyMinute();

//        $schedule->call(function() use($http_client){
//            try{
//                $http_client->get($_ENV['APP_URL'] . "/hotel/cancelUncheckOrder")->getBody()->getContents();
//                Log::info('[cancelUncheckOrder定时任务执行成功]');
//            }catch(Exception $e){
//                Log::info('[cancelUncheckOrder定时任务执行失败]：' . $e->getMessage());
//            }
//        })->dailyAt('19:00');

        $schedule->call(function() use($http_client){
            try{
                $http_client->get($_ENV['APP_URL'] . "/hotel/checkoutOrder")->getBody()->getContents();
                Log::info('[checkoutOrder定时任务执行成功]');
            }catch(Exception $e){
                Log::info('[checkoutOrder定时任务执行失败]：' . $e->getMessage());
            }
        })->dailyAt('19:00');

        $schedule->call(function() use($http_client){
            try{
                $http_client->get($_ENV['APP_URL'] . "/hotel/completeOrder")->getBody()->getContents();
                Log::info('[completeOrder定时任务执行成功]');
            }catch(Exception $e){
                Log::info('[completeOrder定时任务执行失败]：' . $e->getMessage());
            }
        })->daily();

        $schedule->call(function() use($http_client){
            try{
                $http_client->get($_ENV['APP_URL'] . "/rcu/execDdcTask")->getBody()->getContents();
                Log::info('[execDdcTask定时任务执行成功]');
            }catch(Exception $e){
                Log::info('[execDdcTask定时任务执行失败]：' . $e->getMessage());
            }
        })->everyMinute();
    }
}
