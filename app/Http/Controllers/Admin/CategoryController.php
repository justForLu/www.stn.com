<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Http\Requests\Admin\CategoryRequest;
use App\Repositories\Admin\Criteria\CategoryCriteria;
use App\Repositories\Admin\CategoryRepository as Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class CategoryController extends BaseController
{
    /**
     * @var Category
     */
    protected $category;

    public function __construct(Category $category)
    {
        parent::__construct();

        $this->category = $category;
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

        $this->category->pushCriteria(new CategoryCriteria($params));

        $list = $this->category->paginate(Config::get('admin.page_size',10));

        return view('admin.category.index',compact('params','list'));
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
     * @param CategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->filterAll();

        $data = $this->category->create($data);

        if($data){
            return $this->ajaxSuccess(null,'添加成功',route('admin.category.index'));
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
        return view('admin.category.show');
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

        $data = $this->category->find($id);
        return view('admin.category.edit',compact('data','params'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        $data = $request->filterAll();

        //获取分类信息
        $category = $this->category->find($id);

        $result = $this->category->update($data,$id);

        return $this->ajaxAuto($result,'修改',route('admin.category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $info = $this->category->find($id);

        $result = $this->category->delete($id);

        return $this->ajaxAuto($result,'删除');
    }

    /**
     * 获取下级自检分类
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChildrenCategory(Request $request){
        $params = $request->all();

        $list = array();
        if(isset($params['id']) && !empty($params['id'])){
            $where['parent'] = $params['id'];
            $where['status'] = BasicEnum::ACTIVE;
            $list = $this->category->findWhere($where);
        }
        return response()->json($list);
    }
}