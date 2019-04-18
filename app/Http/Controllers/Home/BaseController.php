<?php
namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
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

        $this->callback = isset($_SERVER['HTTP_REFERER']) ? urlencode($_SERVER['HTTP_REFERER']) : '';

        view()->share('callback',$this->callback);
    }


}
