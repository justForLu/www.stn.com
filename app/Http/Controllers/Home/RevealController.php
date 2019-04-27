<?php
namespace App\Http\Controllers\Home;

use App\Enums\BannerPositionEnum;
use App\Enums\BasicEnum;
use App\Http\Controllers\Admin\FileController;
use App\Models\Home\Banner;
use App\Repositories\Home\Criteria\RevealCriteria;
use App\Repositories\Home\RevealRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class RevealController extends BaseController
{
    /**
     * @var RevealRepository
     */
    protected $reveal;

    public function __construct(RevealRepository $reveal)
    {
        parent::__construct();
        //案例展示的banner
        $banner = Banner::where('status','=',BasicEnum::ACTIVE)
            ->where('position','=',BannerPositionEnum::REVEAL1)
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

        $this->reveal = $reveal;
    }

    /**
     * 案例展示
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->reveal->pushCriteria(new RevealCriteria(array()));

        $list = $this->reveal->paginate(Config::get('home.page_size',10));
        //处理图片
        foreach($list as $key => $value){
            $list[$key]['cover_path'] = array_values(FileController::getFilePath($value['cover']));
            $reveal_image = array_values(FileController::getFilePath($value->cover));
            $list[$key]['cover_path'] = isset($reveal_image[0]) ? $reveal_image[0] : '';
        }

        return view('home.reveal.index',compact('list'));
    }

    /**
     * 案例展示详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id){

        $reveal = $this->reveal->find($id);

        $reveal->images = array_values(FileController::getFilePath($reveal->image));

        return view('home.reveal.detail',compact('reveal'));
    }



}




