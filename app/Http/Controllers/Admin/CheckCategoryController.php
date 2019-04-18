<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Models\Admin\CheckContent;
use App\Http\Requests\Admin\CheckCategoryRequest;
use App\Repositories\Admin\Criteria\CheckCategoryCriteria;
use App\Repositories\Admin\CheckCategoryRepository as CheckCategory;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class CheckCategoryController extends BaseController
{
    /**
     * @var CheckCategory
     */
    protected $check_category;

    public function __construct(CheckCategory $check_category)
    {
        parent::__construct();

        $this->check_category = $check_category;
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

        $this->check_category->pushCriteria(new CheckCategoryCriteria($params));

        $list = $this->check_category->paginate(Config::get('admin.page_size',10));

        return view('admin.check_category.index',compact('params','list'));
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
     * @param CheckCategoryRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckCategoryRequest $request)
    {
        $data = $request->filterAll();

        $data = $this->check_category->create($data);
        $this->check_category->updatePath($data['parent'],$data->id);

        if($data){
            return $this->ajaxSuccess(null,'添加成功',route('admin.check_category.index',array('parent' => $data['parent'])));
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

        $data = $this->check_category->find($id);
        return view('admin.check_category.edit',compact('data','params'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CheckCategoryRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckCategoryRequest $request, $id)
    {
        $data = $request->filterAll();

        //获取分类信息
        $category = $this->check_category->find($id);

        $result = $this->check_category->update($data,$id);

        if(isset($category['parent'])){
            return $this->ajaxAuto($result,'修改',route('admin.check_category.index',array('parent' => $category['parent'])));
        }else{
            return $this->ajaxAuto($result,'修改',route('admin.check_category.index'));

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $info = $this->check_category->find($id);

        $result = $this->check_category->delete($id);

        if($result){
            //删除该自检类型下的自检内容
            $test = CheckContent::where('type_second_id','=',$id)->delete();
        }

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
            $list = $this->check_category->findWhere($where);
        }
        return response()->json($list);
    }
}
