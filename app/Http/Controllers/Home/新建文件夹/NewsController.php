<?php
namespace App\Http\Controllers\Home;

use App\Models\Home\Collection;
use App\Models\Home\News;
use App\Http\Controllers\Admin\FileController;
use App\Http\Requests\Home\NewsRequest;
use App\Repositories\Home\Criteria\NewsCriteria;
use App\Repositories\Home\NewsRepository;
use App\Repositories\Home\Criteria\CollectionCriteria;
use App\Repositories\Home\CollectionRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class NewsController extends BaseController
{

    /**
     * @var NewsRepository
     */
    protected $news;

    /**
     * @var CollectionRepository
     */
    protected $collection;

    public function __construct(NewsRepository $news,CollectionRepository $collection)
    {
        parent::__construct();

        //获取URL参数并转为数组
        $last_url = (urldecode($_SERVER["QUERY_STRING"]));
        parse_str($last_url, $arr);
        //获取token，然后根据token去请求接口，得到ID。
        if( isset($arr['token']) ){
            if(!empty(session('token'))){
                if(session('token') != $arr['token']){
                    session(['token' => $arr['token']]);
                }
            }else{
                session(['token' => $arr['token']]);
            }
        }
        $this->token = session('token');
        $this->news = $news;
        $this->collection = $collection;
    }


    /**
     * 新闻列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $token = !empty($this->token) ? $this->token : '';  //接收到的token
        //判断session里是否有用户信息
        $user_info['user_id'] = !empty(session('user_id')) ? session('user_id') : 0;
        $user_info['user_name'] = !empty(session('user_name')) ? session('user_name') : null;

        $this->news->pushCriteria(new NewsCriteria($params));

        $list = $this->news->paginate(Config::get('home.page_size',10));

        //处理图片
        foreach($list as $key => $value){
            $list[$key]['image_path'] = array_values(FileController::getFilePath($value['image']));
            if(count($list[$key]['image_path'])){
                $list[$key]['image_path'] = $list[$key]['image_path'][0];
            }else{
                $list[$key]['image_path'] = '';
            }
        }

        return view('home.news.index',compact('list','user_info','token'));
    }

    /**
     * 新闻详情
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id,Request $request){
        $params = $request->all();
        $token = !empty($this->token) ? $this->token : '';  //接收到的token
        //判断是不是从收藏那里点过来的
        $from_collect = 0;
        if(isset($params['from']) && ($params['from'] == 'collect')){
            $from_collect = 1;
        }
Log::info('-------------');
Log::info($token);
        $news = $this->news->find($id);
        //处理图片
        $news['image_path'] = array_values(FileController::getFilePath($news['image']));
        if(count($news['image_path'])){
            $news['image_path1'] = substr($news['image_path'][0],1);  //FOR base64
            $news['image_path'] = 'http://47.96.18.142:81'.($news['image_path'][0]); //TODO
        }else{
            $news['image_path'] = '';
        }
        $image_path1 = isset($news['image_path1']) ? $news['image_path1'] : '';

        $news['image_base64'] = $this->base64EncodeImage($image_path1);


        //判断session里是否有用户信息
        $collect_info = Collection::where('news_id','=',$id)
            ->first();
        $user_id = !empty(session('user_id')) ? session('user_id') : $collect_info['user_id'];
        if($collect_info){
            $collection = true;
        }else{
            $collection = false;
        }

        return view('home.news.details',compact('news','collection','user_id','from_collect','token'));
    }


    /**
     * 新闻收藏
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function collect_news(Request $request){
        $params = $request->all();

        //如果没有用户ID，直接返回空
        if(empty($params['user_id'])){
            return response()->json('');
        }
        //1表示收藏，2表示取消收藏
        if($params['type'] == 1){
            //清除相关收藏信息
            Collection::where('news_id','=',$params['news_id'])
                ->where('user_id','=',$params['user_id'])
                ->delete();
            //收藏信息数据
            $data['news_id'] = $params['news_id'];
            $data['user_id'] = $params['user_id'];
            $data['gmt_create'] = get_date();
            $result = Collection::create($data);
        }elseif($params['type'] == 2){
            $result = Collection::where('news_id','=',$params['news_id'])
                ->where('user_id','=',$params['user_id'])
                ->delete();
        }else{
            $result = false;
        }

        return response()->json($result);
    }

    /**
     * 获取”我的收藏“之”新闻收藏“的接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_collect_news(Request $request){
        $params = $request->all();
        $token = !empty($this->token) ? $this->token : '';  //接收到的token
        //判断session里是否有用户信息
        $params['user_id'] = !empty(session('user_id')) ? session('user_id') : -1;
        if($params['user_id'] == -1){
            //根据token获取用户信息
            $url = 'http://gateway.dw.limajituan.com:9051/auth/login/store/token?token=' . $token;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER,0);
            $user_result = curl_exec($ch);
            curl_close($ch);
            $user_result = json_decode($user_result,true);  //json字符串转数组

            if(isset($user_result['data']['userId'])){
                $user_info['user_id'] = $user_result['data']['userId'];
            }else{
                $user_info['user_id'] = 0;
            }
            $params['user_id'] = $user_info['user_id'];
        }
        //返回收藏信息
        $this->collection->pushCriteria(new CollectionCriteria($params));

        $list = $this->collection->paginate(Config::get('home.page_size',10));
        $arr = array();
        foreach($list as $key => $value){
            $arr[$key] = News::select('id','title','introduce','gmt_create')
                ->where('id','=',$value['news_id'])
                ->first();
            //如果没有获取到新闻，则清理掉本条返回信息
            if(count($arr[$key]) == 0){
                unset($arr[$key]);
            }else{
                $arr[$key]['url'] = 'http://47.96.18.142:81/home/news/details/' . $value['news_id'] .'?from=collect';
            }
            unset($list[$key]);
        }

        $list['news'] = $arr;

        return $this->ajaxSuccess($list,'成功','','200');
    }

    /**
     * 请求佳林那边的接口，根据token获取用户信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserInfo(Request $request){
        $params = $request->all();

        //根据token获取用户信息
        $token = !empty($params['token']) ? $params['token'] : '';
        $url = 'http://gateway.dw.limajituan.com:9051/auth/login/store/token?token=' . $token;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER,0);
        $user_result = curl_exec($ch);
        curl_close($ch);
        $user_result = json_decode($user_result,true);  //json字符串转数组
        if(isset($user_result['data']['userId'])){
            //将获取到的数据存到session里，当有这些用户信息的时候，就不再请求这个接口了
            session(['user_id' => $user_result['data']['userId']]);
            session(['user_name' => $user_result['data']['loginName']]);
            $user_info['user_id'] = $user_result['data']['userId'];
            $user_info['user_name'] = $user_result['data']['loginName'];
        }else{
            $user_info['user_id'] = 0;
            $user_info['user_name'] = null;
        }

        return response()->json($user_info);
    }

    /**
     * base64图片转换
     * @param $image_file
     * @return string
     */
    function base64EncodeImage ($image_file) {
        $base64_image = '';
        if(file_exists($image_file)){
            $image_info = getimagesize($image_file);
            $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
            $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
        }

        return $base64_image;
    }

}




