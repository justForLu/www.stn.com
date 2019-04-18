<?php
namespace App\Http\Controllers\Home;

use App\Enums\BasicEnum;
use App\Http\Requests\Home\CheckContentRequest;
use App\Models\Admin\CheckContent;
use Illuminate\Http\Request;
use App\Http\Requests;

class CheckContentController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * 问题首页（即详情）
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id,Request $request)
    {
        $params = $request->all();

        $check_content = CheckContent::where('id','=',$id)->where($params)->first();

        //将read数加1
        if(isset($check_content['read'])){
            $data['read'] = $check_content['read'] + 1;
            CheckContent::where('id','=',$check_content['id'])->update($data);
        }

        return view('home.check_content.index',compact('check_content'));
    }

    /**
     * @param CheckContentRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function details(CheckContentRequest $request)
    {
        $params = $request->filterAll();

        $check_content = CheckContent::where('status','=',BasicEnum::ACTIVE)->where($params)->first();

        //将read数加1
        if(isset($check_content['read'])){
            $data['read'] = $check_content['read'] + 1;
            CheckContent::where('id','=',$check_content['id'])->update($data);
        }

        if(count($check_content) == 0){
            return redirect('/home/check_content/null');
        }else{
            return view('home.check_content.index',compact('check_content'));
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function null(){
        return view('home.check_content.null');
    }

}




