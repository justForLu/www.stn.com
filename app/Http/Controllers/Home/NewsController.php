<?php
namespace App\Http\Controllers\Home;

use App\Enums\BannerPositionEnum;
use App\Enums\BasicEnum;
use App\Enums\CategoryTypeEnum;
use App\Models\Home\Banner;
use App\Models\Home\Category;
use App\Models\Home\News;
use App\Http\Controllers\Admin\FileController;
use App\Repositories\Home\Criteria\NewsCriteria;
use App\Repositories\Home\NewsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class NewsController extends BaseController
{

    /**
     * @var NewsRepository
     */
    protected $news;


    public function __construct(NewsRepository $news)
    {
        parent::__construct();

        //新闻资讯的banner
        $banner = Banner::where('status','=',BasicEnum::ACTIVE)
            ->where('position','=',BannerPositionEnum::NEWS)
            ->orderBy('sort','ASC')
            ->first();
        if($banner){
            $banner->toArray();
            $banner_image = array_values(FileController::getFilePath($banner['image']));
            $banner['image_path'] = isset($banner_image[0]) ? $banner_image[0] : '';
        }else{
            $banner = array();
            $banner['image_path'] = '';
        }
        view()->share('banner', $banner);

        $this->news = $news;
    }


    /**
     * 新闻列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        //新闻资讯分类菜单
        $menu = array();
        $category = Category::where('type','=',CategoryTypeEnum::NEWS)
            ->where('status','=',BasicEnum::ACTIVE)
            ->orderBy('sort','ASC')
            ->get();
        if(isset($params['type']) && !empty($params['type'])){
            foreach ($category as $key => $value){
                $menu[$key]['menu_url'] = url('/home/news/index', array('type' => $value['id']));
                $menu[$key]['title'] = $value['name'];
                $menu[$key]['is_active'] = ($value['id'] == $params['type']) ? 'yes' : 'no';
            }
        }else{
            foreach ($category as $key => $value){
                $menu[$key]['menu_url'] = url('/home/news/index', array('type' => $value['id']));
                $menu[$key]['title'] = $value['name'];
                $menu[$key]['is_active'] = ($key == 0) ? 'yes' : 'no';
            }
            $params['type'] = isset($category[0]['id']) ? $category[0]['id'] : '0';
        }

        $this->news->pushCriteria(new NewsCriteria($params));

        $list = $this->news->paginate(Config::get('home.page_size',10));

        //处理图片
        foreach($list as $key => $value){
            $list[$key]['image_path'] = array_values(FileController::getFilePath($value['image']));
            $news_image = array_values(FileController::getFilePath($value->image));
            $list[$key]['image_path'] = isset($news_image[0]) ? $news_image[0] : '';
        }

        return view('home.news.index',compact('list','menu'));
    }

    /**
     * 新闻详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id){

        $news = $this->news->find($id);
        //新闻资讯分类菜单
        $menu = array();
        $category = Category::where('type','=',CategoryTypeEnum::NEWS)
            ->where('status','=',BasicEnum::ACTIVE)
            ->orderBy('sort','ASC')
            ->get();
        foreach ($category as $key => $value){
            $menu[$key]['menu_url'] = url('/home/news/index', array('type' => $value['id']));
            $menu[$key]['title'] = $value['name'];
            $menu[$key]['is_active'] = ($value['id'] == $news->type) ? 'yes' : 'no';
        }

        $news->content = htmlspecialchars_decode($news->content);
        //TODO 搜索上一条和下一条新闻
        //搜索上一条和下一条新闻
        if($news){
            $last = News::where('status','=',BasicEnum::ACTIVE)
                ->orderBy('sort','ASC')
                ->get();
        }else{
            $last = '没有了';
            $next = '没有了';
        }
        //新闻资讯阅读量加1
        News::where('id','=',$id)->update(array('read' => ($news->read + 1)));

        return view('home.news.detail',compact('news', 'banner', 'menu'));
    }


}




