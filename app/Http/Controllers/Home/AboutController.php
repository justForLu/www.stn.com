<?php
namespace App\Http\Controllers\Home;

use App\Enums\BannerPositionEnum;
use App\Enums\BasicEnum;
use App\Http\Controllers\Admin\FileController;
use App\Models\Home\Banner;
use App\Models\Home\About;

class AboutController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * 关于我们
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $about = About::first();
        $about->content = htmlspecialchars_decode($about->content);
        //关于我们的banner
        $banner = Banner::where('status','=',BasicEnum::ACTIVE)
            ->where('position','=',BannerPositionEnum::ABOUT)
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

        return view('home.about.index',compact('about', 'banner'));
    }

}




