<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Http\Requests\Admin\AboutRequest;
use App\Repositories\Admin\Criteria\AboutCriteria;
use App\Repositories\Admin\AboutRepository as About;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class AboutController extends BaseController
{
    /**
     * @var About
     */
    protected $about;

    public function __construct(About $about)
    {
        parent::__construct();

        $this->about = $about;
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

        $this->about->pushCriteria(new AboutCriteria($params));

        $list = $this->about->paginate(Config::get('admin.page_size',10));

        return view('admin.about.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $params = $request->input();
        return view('admin.about.create',compact('params'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AboutRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AboutRequest $request)
    {
        $data = $request->filterAll();

        $data = $this->about->create($data);

        if($data){
            return $this->ajaxSuccess(null,'添加成功',route('admin.about.index'));
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
        return view('admin.about.show');
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

        $data = $this->about->find($id);
        return view('admin.about.edit',compact('data','params'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AboutRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AboutRequest $request, $id)
    {
        $data = $request->filterAll();

        //获取分类信息
        $category = $this->about->find($id);

        $result = $this->about->update($data,$id);

        return $this->ajaxAuto($result,'修改',route('admin.about.index'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $info = $this->about->find($id);

        $result = $this->about->delete($id);

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
            $list = $this->about->findWhere($where);
        }
        return response()->json($list);
    }
}
