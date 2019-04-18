<?php
namespace App\Http\Controllers\Home;

use App\Enums\BasicEnum;
use App\Models\Admin\CheckCategory;
use App\Models\Admin\CheckContent;
use Illuminate\Http\Request;
use App\Http\Requests;

class CheckCategoryController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * 自检手册分类
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();

        $list = CheckCategory::where('status','=',BasicEnum::ACTIVE)
            ->where('parent','=',0)
            ->where($params)
            ->orderBy('sort','ASC')
            ->orderBy('id', 'DESC')
            ->get();

        //常见问题
        $problem = CheckContent::where('status','=',BasicEnum::ACTIVE)
            ->orderBy('read','desc')
            ->limit(10)
            ->get();

        return view('home.check_category.index',compact('list','problem'));
    }

    /**
     * 自检手册分类详情
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id,Request $request){

        $check_category = CheckCategory::where('id',$id)->first();

        //子级分类
        $children_category = CheckCategory::where('status','=',BasicEnum::ACTIVE)
            ->where('parent','=',$id)
            ->orderBy('sort','ASC')
            ->orderBy('id', 'DESC')
            ->get();
        //分类下的问题。
        foreach($children_category as $key => $value){
            $problem = CheckContent::where('status','=',BasicEnum::ACTIVE)
                ->where('type_second_id','=',$value['id'])
                ->get();
            $children_category[$key]['problem'] = $problem;
        }

        return view('home.check_category.details',compact('check_category','children_category'));
    }

}




