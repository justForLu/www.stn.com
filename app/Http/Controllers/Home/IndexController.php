<?php
namespace App\Http\Controllers\Home;


use App\Enums\BannerPositionEnum;
use App\Enums\BasicEnum;
use App\Enums\CategoryTypeEnum;
use App\Http\Controllers\Admin\FileController;
use App\Models\Admin\About;
use App\Models\Admin\Banner;
use App\Models\Admin\Category;
use App\Models\Admin\Contact;
use App\Models\Admin\File;
use App\Models\Admin\News;
use App\Models\Admin\Product;
use App\Models\Admin\Reveal;
use Illuminate\Support\Facades\Log;

class IndexController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        /*  网站首页部分的banner图  */
        $index_banner = Banner::where('position','=',BannerPositionEnum::INDEX)
            ->where('status','=',BasicEnum::ACTIVE)
            ->limit(3)
            ->orderBy('sort','ASC')
            ->get();
        //处理图片
        foreach ($index_banner as $key => $value){
            $banner_image = array_values(FileController::getFilePath($value->image));
            $index_banner[$key]['image_path'] = isset($banner_image[0]) ? $banner_image[0] : '';
        }

        /*  关于我们部分的banner图和简介   */
        $about_banner = Banner::where('position','=',BannerPositionEnum::ABOUT1)
            ->where('status','=',BasicEnum::ACTIVE)
            ->orderBy('sort','ASC')
            ->first();
        //处理图片
        $banner_image = array_values(FileController::getFilePath($about_banner->image));
        $about_banner['image_path'] = isset($banner_image[0]) ? $banner_image[0] : '';
        //关于我们的简介
        $about = About::first();
        $about->images = FileController::getFilePath($about->image);
        $about->content = htmlspecialchars_decode($about->content);

        /*  产品中心部分的banner图和产品展示   */
        $product_banner = Banner::where('position','=',BannerPositionEnum::PRODUCT1)
            ->where('status','=',BasicEnum::ACTIVE)
            ->orderBy('sort','ASC')
            ->first();
        //处理图片
        $banner_image = array_values(FileController::getFilePath($product_banner->image));
        $product_banner['image_path'] = isset($banner_image[0]) ? $banner_image[0] : '';
        //产品分类以及产品分类下的产品
        $product_category = Category::where('type','=',CategoryTypeEnum::PRODUCT)
            ->where('status','=',BasicEnum::ACTIVE)
            ->orderBy('sort','ASC')
            ->get();
        foreach ($product_category as $key => $value){
            //搜索分类下的产品，4个，排序
            $product_list = Product::where('status','=',BasicEnum::ACTIVE)
                ->where('type','=',$value->id)
                ->limit(4)
                ->orderBy('sort','ASC')
                ->get();
            //处理产品的图片
            foreach ($product_list as $k => $val){
                $product_image = array_values(FileController::getFilePath($val->image));
                $product_list[$k]['image_path'] = isset($product_image[0]) ? $product_image[0] : '';
            }
            $product_category[$key]['product'] = $product_list;
        }

        /*  案例展示部分简介、banner图和展示   */
        $reveal_banner = Banner::where('position','=',BannerPositionEnum::REVEAL1)
            ->where('status','=',BasicEnum::ACTIVE)
            ->orderBy('sort','ASC')
            ->first();
        //处理图片
        $banner_image = array_values(FileController::getFilePath($reveal_banner->image));
        $reveal_banner['image_path'] = isset($banner_image[0]) ? $banner_image[0] : '';

        $reveal_list = Reveal::where('status','=',BasicEnum::ACTIVE)
            ->limit(6)
            ->orderBy('sort','ASC')
            ->get();
        //处理图片
        foreach ($reveal_list as $key => $value){
            $reveal_cover = array_values(FileController::getFilePath($value->cover));
            $reveal_list[$key]['cover_path'] = isset($reveal_cover[0]) ? $reveal_cover[0] : '';
        }

        /*  新闻资讯部分的banner图、第一条新闻展示和部分新闻展示   */
        $news_banner = Banner::where('position','=',BannerPositionEnum::NEWS1)
            ->where('status','=',BasicEnum::ACTIVE)
            ->orderBy('sort','ASC')
            ->first();
        //处理图片
        $banner_image = array_values(FileController::getFilePath($news_banner->image));
        $news_banner['image_path'] = isset($banner_image[0]) ? $banner_image[0] : '';

        $news_category = Category::where('type','=',CategoryTypeEnum::NEWS)
            ->where('status','=',BasicEnum::ACTIVE)
            ->limit(2)
            ->orderBy('sort','ASC')
            ->get();
        //获取分类下的新闻，并处理图片
        foreach ($news_category as $key => $value){
            $news_list = News::where('status','=',BasicEnum::ACTIVE)
                ->where('type','=',$value->id)
                ->limit(5)
                ->orderBy('sort','ASC')
                ->get();
            foreach ($news_list as $k => $val){
                $news_image = array_values(FileController::getFilePath($val->image));
                $news_list[$k]['image_path'] = isset($news_image[0]) ? $news_image[0] : '';
                $news_list[$k]['content'] = htmlspecialchars_decode($val->content);
            }
            $news_category[$key]['news'] = $news_list;
        }

        /*  联系我们的地图   */
        $contact_banner = Banner::where('position','=',BannerPositionEnum::CONTACT1)
            ->where('status','=',BasicEnum::ACTIVE)
            ->orderBy('sort','ASC')
            ->first();
        //处理图片
        $banner_image = array_values(FileController::getFilePath($contact_banner->image));
        $contact_banner['image_path'] = isset($banner_image[0]) ? $banner_image[0] : '';

        $contact = Contact::first();


        return view('home.index.index', compact('index_banner','about','about_banner','product_banner',
            'product_category','news_banner','news_category','reveal_list','reveal_banner','contact_banner','contact'));
    }

}




