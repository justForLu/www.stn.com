<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Http\Requests\Admin\BannerRequest;
use App\Repositories\Admin\Criteria\BannerCriteria;
use App\Repositories\Admin\BannerRepository as Banner;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class BannerController extends BaseController
{
    /**
     * @var Banner
     */
    protected $banner;

    public function __construct(Banner $banner)
    {
        parent::__construct();

        $this->banner = $banner;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();

        $this->banner->pushCriteria(new BannerCriteria($params));

        $list = $this->banner->paginate(Config::get('admin.page_size',10));

        return view('admin.banner.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $params = $request->input();
        return view('admin.banner.create',compact('params'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BannerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BannerRequest $request)
    {
        $data = $request->filterAll();

        $data = $this->banner->create($data);

        if($data){
            return $this->ajaxSuccess(null,'添加成功',route('admin.banner.index'));
        }else{
            return $this->ajaxError('添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.banner.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $params = $request->all();
        $params['id'] = $id;

        $data = $this->banner->find($id);
        return view('admin.banner.edit',compact('data','params'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BannerRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BannerRequest $request, $id)
    {
        $data = $request->filterAll();

        //获取分类信息
        $category = $this->banner->find($id);

        $result = $this->banner->update($data,$id);

        return $this->ajaxAuto($result,'修改',route('admin.banner.index'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $info = $this->banner->find($id);

        $result = $this->banner->delete($id);

        return $this->ajaxAuto($result,'删除');
    }

    /**
     * 获取下级自检分类
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getChildrenCategory(Request $request){
        $params = $request->all();

        $list = array();
        if(isset($params['id']) && !empty($params['id'])){
            $where['parent'] = $params['id'];
            $where['status'] = BasicEnum::ACTIVE;
            $list = $this->banner->findWhere($where);
        }
        return response()->json($list);
    }
}
