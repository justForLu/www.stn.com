<?php
namespace App\Http\Controllers\Home;


use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Controller;
use App\Models\Admin\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class BaseController extends Controller
{
    protected $callback;

    /**
     * 父类构造器(接口请求拦截)
     * BaseController constructor.
     */
    public function __construct(){

        //网站配置的基本信息
        $config = Config::first();
        $code_path = array_values(FileController::getFilePath($config->code));
        $config->code_path = isset($code_path[0]) ? $code_path[0] : '';


        $this->callback = isset($_SERVER['HTTP_REFERER']) ? urlencode($_SERVER['HTTP_REFERER']) : '';

        view()->share('callback',$this->callback);
        view()->share('config', $config);
    }


}
