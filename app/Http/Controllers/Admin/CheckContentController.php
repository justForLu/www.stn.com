<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Models\Admin\CheckCategory;
use App\Http\Requests\Admin\CheckContentRequest;
use App\Repositories\Admin\Criteria\CheckContentCriteria;
use App\Repositories\Admin\CheckContentRepository as CheckContent;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class CheckContentController extends BaseController
{
    /**
     * @var CheckContent
     */
    protected $check_content;

    public function __construct(CheckContent $check_content)
    {
        parent::__construct();

        $this->check_content = $check_content;
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

        $this->check_content->pushCriteria(new CheckContentCriteria($params));

        $list = $this->check_content->paginate(Config::get('admin.page_size',10));

        //处理关联类型
        foreach($list as $key => $value){
            $type_first = CheckCategory::select('name')->where('id','=',$value['type_first_id'])->first();
            $type_second = CheckCategory::select('name')->where('id','=',$value['type_second_id'])->first();
            $list[$key]['type_first'] = $type_first['name'];
            $list[$key]['type_second'] = $type_second['name'];
        }
        return view('admin.check_content.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_list = CheckCategory::where('status','=',BasicEnum::ACTIVE)
            ->where('parent','=',0)
            ->get();

        return view('admin.check_content.create',compact('category_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CheckContentRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckContentRequest $request)
    {
        $data = $request->filterAll();

        //创建时间
        $data['gmt_create'] = get_date();

        $data = $this->check_content->create($data);

        if($data){
            return $this->ajaxSuccess(null,'添加成功',route('admin.check_content.index'));
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
        $check_content = $this->check_content->find($id);
        $check_content->type_first = CheckCategory::select('name')->where('id','=',$check_content['type_first_id'])->first();
        $check_content->type_second = CheckCategory::select('name')->where('id','=',$check_content['type_second_id'])->first();

        return view('admin.check_content.show',compact('check_content'));
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
        $category_list = CheckCategory::where('status','=',BasicEnum::ACTIVE)
            ->where('parent','=',0)
            ->get();

        $check_content = $this->check_content->find($id);
        return view('admin.check_content.edit',compact('check_content','category_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CheckContentRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckContentRequest $request, $id)
    {
        $data = $request->filterAll();

        //修改时间
        $data['gmt_update'] = get_date();

        $result = $this->check_content->update($data,$id);

        return $this->ajaxAuto($result,'修改',route('admin.check_content.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $result = $this->check_content->delete($id);

        return $this->ajaxAuto($result,'删除');
    }
}
