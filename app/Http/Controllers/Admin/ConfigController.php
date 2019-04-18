<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Http\Requests\Admin\ConfigRequest;
use App\Repositories\Admin\Criteria\ConfigCriteria;
use App\Repositories\Admin\ConfigRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class ConfigController extends BaseController
{
    /**
     * @var Config
     */
    protected $config;

    public function __construct(ConfigRepository $config)
    {
        parent::__construct();

        $this->config = $config;
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

        $this->config->pushCriteria(new ConfigCriteria($params));

        $list = $this->config->paginate(Config::get('admin.page_size',10));

        return view('admin.config.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $params = $request->input();
        return view('admin.check_category.create',compact('params'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ConfigRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ConfigRequest $request)
    {
        $data = $request->filterAll();

        $data = $this->config->create($data);

        if($data){
            return $this->ajaxSuccess(null,'添加成功',route('admin.config.index'));
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
        return view('admin.check_category.show');
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

        $data = $this->config->find($id);
        return view('admin.check_category.edit',compact('data','params'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ConfigRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ConfigRequest $request, $id)
    {
        $data = $request->filterAll();

        //获取分类信息
        $category = $this->config->find($id);

        $result = $this->config->update($data,$id);

        return $this->ajaxAuto($result,'修改',route('admin.config.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $info = $this->config->find($id);

        $result = $this->config->delete($id);

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
            $list = $this->config->findWhere($where);
        }
        return response()->json($list);
    }
}
